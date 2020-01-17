@extends('welcome')
@section('content')

<div id="mainViewContainer">
	<div id="mainContent">
		<h1 class="pageHeadingBig">Artist Lists</h1>

			<div class="gridViewContainer">
				@foreach($artists as $row)
					<div class='gridViewItem'>
						<a href="{{route('art.show',$row->id)}}">
							<img src="{{asset($row->photo)}}" style="border-radius: 50%">
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