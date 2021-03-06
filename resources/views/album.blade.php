@extends('welcome')
@section('content')

<div id="mainViewContainer">
	<div id="mainContent">
		<div class="entityInfo">
			<div class="leftSection">
				<img src="{{asset($albums->artworkPath)}}">
			</div>

			<div class="rightSection">
				<h2>{{$albums->title}}</h2>
				<p>{{$artists->name}}</p>
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
				<script>
					var tempSongIds = '<?php echo json_encode($songs); ?>';
					tempPlaylist = JSON.parse(tempSongIds);

					/*console.log(tempPlaylist);
					console.log(typeof tempPlaylist);*/
				</script>
			</ul>
		</div>
	</div>
</div>
@endsection
