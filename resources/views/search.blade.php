@extends('welcome')

@section('content')
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
	<script type="text/javascript">
	$(document).ready(function() {

		var timer;
    var searchSong=[];
       $('#search').keyup(function(){
       		//alert("hello");
       		timer=setTimeout(function(){
        	var searchval=$('#search').val();
        	//console.log(searchval);
        	if(searchval){
        	search_data(searchval);}
        },500);
        })

       function search_data(searchdata){
       	var searchval=searchdata;
       	//alert(searchval);
       	$.ajax({
       		url:"{{route('searches')}}",
       		method:'POST',
       		data:{searchval:searchval,_token: '{{csrf_token()}}'},
       		dataType:'json',
       		success:function(response){
       			//console.log(response);
       			var html="";
       			var data="";
       			var j=1;
            
       			$.each(response,function(i,v){
       				var title=v.title;
              var songid=v.id;
       				var duration=v.duration;
       				var artist=v.artistname;
              searchSong=v.path;

              var routeURL="{{route('songs.download',':id')}}";
              routeURL=routeURL.replace(':id',songid);
       				
       				console.log(typeof searchSong);
       				data+=`<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src="{{asset('images/icons/play-white.png')}}" onclick='setTrack(searchPlaylist[`+songid+`], searchPlaylist, true)'>
						<span class='trackNumber'>`+ j +`</span>
					</div>

					<div class='trackInfo'>
						<span class='trackName'>`+title+`</span>
						<span class='artistName'>`+artist+`</span>
					</div>

					<div class='trackOptions'>
						<a href="`+routeURL+`">
            <i class="fas fa-arrow-circle-down"></i>
            </a>
					</div>

					<div class='trackDuration'>
						<span class='duration'>`+duration+`</span>
					</div>


				</li>`;
				j++;
       			})
				$('#searchli').html(data);

       			if(response == 0 ){
       				html="<br><br><span class='noResults'>No found Searching: "+searchval+ "</span>";
       			}
       			$('#searchid').html(html);
           
        }
       	})
       }

       $('#search').keyup(function(){
       		//alert("hello");
       		timer=setTimeout(function(){
        	var searchAlbum=$('#search').val();
        	//alert(searchArtist);
        	if(searchAlbum){
        	search_Album(searchAlbum);}
        },500);
        })

       function search_Album(searchAlbum){
       	var searchalbum=searchAlbum;
       	//alert(searchval);
       	$.ajax({
       		url:"{{route('searchalbums')}}",
       		method:'POST',
       		data:{searchalbum:searchalbum,_token: '{{csrf_token()}}'},
       		dataType:'json',
       		success:function(response){
       			//alert(response);
       			var data="";
       			$.each(response,function(i,v){
              var albumid=v.id;
       				var title=v.title;
       				var artworkpath=v.artworkPath;

              var routeURL = "{{ route('albums.search', ':id' ) }}";
              routeURL = routeURL.replace(':id', albumid);

  				data+=`<div class='gridViewItem'>
  				<span role='link'>
          <a href="`+routeURL+`">
          <img src='`+artworkpath+`'>
  				<div class='gridViewInfo'>`+title+`</div>
          </a>
					</span></div>`;
       			})
				$('#searchAlbum').html(data);
			}
       	})
       }

       $('#search').keyup(function(){
       		//alert("hello");
       		timer=setTimeout(function(){
        	var searchArtist=$('#search').val();
        	//alert(searchArtist);
        	if(searchArtist){
        	search_Artist(searchArtist);}
        },500);
        })

       function search_Artist(searchArtist){
       	var searchartist=searchArtist;
       	//alert(searchval);
       	$.ajax({
       		url:"{{route('searchartists')}}",
       		method:'POST',
       		data:{searchartist:searchartist,_token: '{{csrf_token()}}'},
       		dataType:'json',
       		success:function(response){
       			//alert(response);
       			var data="";
       			$.each(response,function(i,v){
              var artistid=v.id;
       				var name=v.name;
       				var photo=v.photo;
              //alert(photo);

              var routeURL = "{{ route('artists.search', ':id' ) }}";
              routeURL = routeURL.replace(':id', artistid);

  				data+=`<div class='gridViewItem'>
          <a href="`+routeURL+`">
          <img style='border-radius:100%; width:100px; height:100px;' src='`+photo+`'>
          <div class='gridViewInfo'>
          <span style='color:#939393; font-weight:200;position: relative;top: 8px;left: -45px;' role='link' tabindex='0'>
          `+name+`</div></span></a></div>`;
       			})
				$('#searchArtist').html(data);
			}
       	})
       }

    })
</script>
</head>
<body>

</body>
</html>

<div id="mainViewContainer">
<div id="mainContent">

	<div class="searchContainer">
	
	<div id="searchform">
	<input type="text" class="searchInput" value="" placeholder="Start typing..." id="search">
	</div>
	</div>

	<div id="searchid"></div>
	<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist" id="searchli">
	</ul>
	</div>


	<div class="artistsContainer borderBottom">
	<h2>ARTISTS</h2>
		<div id="searchArtist">
			
		</div>
	</div>

	<div class="gridViewContainer">
	<h2>ALBUMS</h2>
	<div id="searchAlbum">
		
	</div>
	</div>


</div>
</div>
<script>
  var searchSongIds = '<?php echo json_encode($songs); ?>';
  searchPlaylist = JSON.parse(searchSongIds);

  /*console.log(searchSongIds);
  console.log(typeof searchPlaylist);*/
</script>

@endsection