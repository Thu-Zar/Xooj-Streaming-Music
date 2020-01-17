@extends('welcome')
@section('content')

<div id="mainViewContainer">
	<div id="mainContent">
		<h1 class="pageHeadingBig">You Might Also Like</h1>

			<div class="gridViewContainer">
				@foreach($albums as $row)
					<div class='gridViewItem'>
						<a href="{{route('index.show',$row->id)}}">
							<img src="{{asset($row->artworkPath)}}">
						</a>
							<div class='gridViewInfo'>
								{{$row->title}}	
							</div>
					</div>
				@endforeach
				
			</div>	
	</div>
</div>
</div>





@endsection