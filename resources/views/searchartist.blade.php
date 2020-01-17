@extends('welcome')

@section('content')
<div id="mainViewContainer">
	<div id="mainContent">
		<div class="entityInfo">
			<div class="leftSection">
				<img style="border-radius: 100%; width:300px;" src="{{asset($artists->photo)}}">
			</div>

			<div class="rightSection ">
				<h2 class="artistAlb" > {{$artists->name}}</h2>
			</div>
		</div>

		<div class="tracklistContainer">
			<ul class="tracklist">
				@php
					$i=1;
					$songNo=0;
				@endphp
				@foreach($songs as $song)

				<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src="{{asset('images/icons/play-white.png')}}" onclick='setTrack(tempPlaylist[{{$songNo++}}], tempPlaylist, true)'>
						<span class='trackNumber'>{{$i++}}</span>
					</div>

					<div class='trackInfo'>
						<span class='trackName'>{{$song->title}}</span>
						<span class='artistName'>{{$artists->name}}</span>
					</div>

					<div class='trackOptions'>
						<a href="{{route('artistsearch.download', $song->id)}}">
            				<i class="fas fa-arrow-circle-down"></i>
						</a>
					</div>

					<div class='trackDuration'>
						<span class='duration'>{{$song->duration}}</span>
					</div>


				</li>
				
				@endforeach	

			</ul>
		</div>
	</div>
</div>
<script>
	var tempSongIds = '<?php echo json_encode($songs); ?>';
	tempPlaylist = JSON.parse(tempSongIds);

	/*console.log(tempPlaylist);
	console.log(typeof tempPlaylist);*/
</script>
@endsection
