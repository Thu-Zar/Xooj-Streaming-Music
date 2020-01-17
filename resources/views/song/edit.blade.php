@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
  <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.fl').click(function(){
        $('.oldPath').hide();
      })
    })
  </script>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Song Edit Form</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

	<form method="post" action="{{route('song.update',$song->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{$song->title}}">
  </div>
 <div class="form-group">
    <label>Artists</label>
    <select name="artist" class="form-control">
      <option value="">Choose Artist</option>
      {-- accept data and loop --}
      @foreach($artists as $row)
      <option value="{{$row->id}}"
        @if($row->id==$song->artist){{'selected'}}
        @endif
        >{{$row->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Albums</label>
    <select name="album" class="form-control">
      <option value="">Choose Album</option>
      {-- accept data and loop --}
      @foreach($albums as $row)
      <option value="{{$row->id}}"
        @if($row->id==$song->album){{'selected'}}
        @endif
        >{{$row->title}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Genres</label>
    <select name="genre" class="form-control">
      <option value="">Choose Genre</option>
      {-- accept data and loop --}
      @foreach($genres as $row)
      <option value="{{$row->id}}"
        @if($row->id==$song->genre){{'selected'}}
        @endif
        >{{$row->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Duration</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="duration" value="{{$song->duration}}">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Song
      <span class="text-danger oldPath">{{$song->path}}</span>
      
      <input type="file" name="song" class="fl">
      <input type="hidden" name="oldsong" value="{{$song->path}}">
    </label>
    
  </div>
  <input type="submit" name="btnsubmit" value="Update" class="btn-primary">
</form>
</div>
</body>
</html>

@endsection