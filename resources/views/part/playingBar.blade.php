@php
    $jsonArray = json_encode($songs);
@endphp
<script>

    $(document).ready(function() {
        newPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        console.log(newPlaylist);
        console.log(typeof newPlaylist);
        setTrack(newPlaylist[0], newPlaylist, false);
        updateVolumeProgressBar(audioElement.audio);

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
            e.preventDefault();
        });




        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if(mouseDown == true) {
                //Set time of song, depending on position of mouse
                timeFromOffset(e, this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });

        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e) {
            if(mouseDown == true) {

                var percentage = e.offsetX / $(this).width();

                if(percentage >= 0 && percentage <= 1) {
                    audioElement.audio.volume = percentage;
                }
            }
        });

        $(".volumeBar .progressBar").mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();

            if(percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        });

        $(document).mouseup(function() {
            mouseDown = false;
        });

    });

    /*to drag progess bar*/
    function timeFromOffset(mouse, progressBar) {
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }
    /*shuffle song*/
    function setShuffle() {
        shuffle = !shuffle;
        var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
        $(".controlButton.shuffle img").attr("src", "../images/icons/" + imageName);

        if(shuffle == true) {
            //Randomize playlist
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
            
        }
        else {
            //shuffle has been deactivated
            //go back to regular playlist
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    }
    /*algoritham for shuffle*/
    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }

    /*major function for playing song*/
    function setTrack(trackId, newPlaylist, play) {

        if(newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }

        if(shuffle == true) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        }
        else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();
        var songid = trackId.id;
        $.ajax({
            type:'POST',
            url:'/ajaxSong',
            data:{ songId: songid ,_token: '{{csrf_token()}}'},
           success:function(data)
           {
                
                $(".sname").text(data.msg.title);

                $.ajax({
                    type:'POST',
                    url:'/ajaxArtist',
                    data:{ artistId: data.msg.artist ,_token: '{{csrf_token()}}'},
                   success:function(data)
                   {
                        $(".aname").text(data.artname.name);
                   } 
               })
                $.ajax({
                    type:'POST',
                    url:'/ajaxAlbum',
                    data:{ albumId: data.msg.album ,_token: '{{csrf_token()}}'},
                   success:function(data)
                   {

                        $(".albumLink img").attr("src", "../"+data.albname.artworkPath);
                       
                    } 
                })

            

                audioElement.setTrack(data.msg);
                playSong();

                
                
            }
        });
      

        if(play == true) {
            audioElement.play();
        }
        
    }

    /*functio for play button*/
    function playSong() {
        if(audioElement.audio.currentTime == 0) {
        $.ajax({
                    type:'POST',
                    url:'/ajaxSongCount',
                    data:{ countId:  audioElement.currentlyPlaying.id ,_token: '{{csrf_token()}}'},
                   success:function(data)
                   {

                       console.log(data);                       
                    } 
                })
    }
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    /*function for pause button*/
    function pauseSong() {

        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

    /*function for next button*/
    function nextSong()
     {

        if(repeat == true) {
        audioElement.setTime(0);
        playSong();
        return;
        }

        if(currentIndex == currentPlaylist.length - 1) {
            currentIndex = 0;
        }
        else {
            currentIndex++;
        }

        var trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true); 
    }

    /*function for repeat button*/
    function setRepeat() {
        repeat = !repeat;
        
        var imageName = repeat ? "repeat-active.png" : "repeat.png";
        $(".controlButton.repeat img").attr("src","../images/icons/" + imageName);
    }

    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0) {
            audioElement.setTime(0);
        }
        else {
            currentIndex = currentIndex - 1;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
        $(".controlButton.volume img").attr("src", "../images/icons/" + imageName);
    }


   

</script>

<div id="nowPlayingBarContainer">

            <div id="nowPlayingBar">

                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img src="{{asset('images/icons/default.png')}}" class="albumArtwork">
                        </span>

                        <div class="trackInfo">

                            <span class="trackName">
                                <span class="sname"></span>
                            </span>

                            <span class="artistName">
                                <span class="aname"></span>
                            </span>

                        </div>



                    </div>
                </div>

                <div id="nowPlayingCenter">

                    <div class="content playerControls">

                        <div class="buttons">

                            <button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
                                <img src="{{asset('images/icons/shuffle.png')}}" alt="Shuffle">
                            </button>

                            <button class="controlButton previous" title="Previous button" onclick="prevSong()">
                                <img src="{{asset('images/icons/previous.png')}}" alt="Previous">
                            </button>

                            <button class="controlButton play" title="Play button" onclick="playSong()">
                                <img src="{{asset('images/icons/play.png')}}" alt="Play">
                            </button>

                            <button class="controlButton pause" title="Pause button" style="display: none;" onclick="pauseSong()">
                                <img src="{{asset('images/icons/pause.png')}}" alt="Pause">
                            </button>

                            <button class="controlButton next" title="Next button" onclick=" nextSong()">
                                <img src="{{asset('images/icons/next.png')}}" alt="Next">
                            </button>

                            <button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
                                <img src="{{asset('images/icons/repeat.png')}}" alt="Repeat" style="border-radius: 300px!important;">
                            </button>

                        </div>


                        <div class="playbackBar">

                            <span class="progressTime current">0.00</span>

                            <div class="progressBar">
                                <div class="progressBarBg">
                                    <div class="progress"></div>
                                </div>
                            </div>

                            <span class="progressTime remaining">0.00</span>


                        </div>


                    </div>


                </div>

                <div id="nowPlayingRight">
                    <div class="volumeBar">

                        <button class="controlButton volume" title="Volume button" onclick="setMute()">
                            <img src="{{asset('images/icons/volume.png')}}" alt="Volume">
                        </button>

                        <div class="progressBar">
                            <div class="progressBarBg">
                                <div class="progress"></div>
                            </div>
                        </div>

                    </div>
                </div>




            </div>

        </div>