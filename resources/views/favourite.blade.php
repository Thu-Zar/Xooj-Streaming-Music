@extends('welcome')
@section('content')

<div id="mainViewContainer">
	<div id="mainContent">
		<div class="entityInfo">
			<div class="leftSection">
				<img src="{{asset('images/icons/fav.jpg')}}">
			</div>

			<div class="rightSection">
				<h2> Favourite Song</h2>
				<p>Keep your heart under music</p>
			</div>
		</div>

		<div class="tracklistContainer">
			<ul class="tracklist">
				@php
				$i=1;
				$songNo=0;
				
				@endphp


				@foreach($songcount as $song)

				<li class='tracklistRow'>
					<div class='trackCount'>

						<img class='play' src="{{asset('images/icons/play-white.png')}}" onclick='setTrack(tempPlaylist[{{$songNo++}}], tempPlaylist, true)'>
						<span class='trackNumber'>{{$i++}}</span>
					</div>

					<div class='trackInfo'>
						<span class='trackName'>{{$song->title}}</span>
						<span class='artistName'>U Listen It {{$song->plays}} times in total</span>
						
					</div>

					<div class='trackOptions'>
						<img class='optionsButton' src="{{asset('images/icons/more.png')}}">
					</div>

					<div class='trackDuration'>
						<span class='duration'>{{$song->duration}}</span>
					</div>
				</li>
				
				@endforeach	
				<script>
					var tempSongIds = '<?php echo json_encode($songcount); ?>';
					tempPlaylist = JSON.parse(tempSongIds);

					/*console.log(tempPlaylist);
					console.log(typeof tempPlaylist);*/
				</script>
			</ul>
		</div>
	</div>
</div>
@endsection
