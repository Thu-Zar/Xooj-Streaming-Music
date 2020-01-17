@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Album Edit Form</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

	<form method="post" action="{{route('album.update',$album->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{$album->title}}">
  </div>

 <div class="form-group">
    <label>Artists</label>
    <select name="artist" class="form-control">
      <option value="">Choose Artist</option>
      {-- accept data and loop --}
      @foreach($artists as $row)
      <option value="{{$row->id}}"
        @if($row->id==$album->artist){{'selected'}}
        @endif
        >{{$row->name}}</option>
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
        @if($row->id==$album->genre){{'selected'}}
        @endif
        >{{$row->name}}</option>
      @endforeach
    </select>
  </div>

 <div class="form-group">
    <label for="exampleInputPassword1">Album Photo
      <span class="text-danger">[support file types:jpeg,png,jpg]</span>
      <input type="file" name="photo">
    </label>
    <img src="{{asset($album->artworkPath)}}" class="img-fluid w-25">
    <input type="hidden" name="oldphoto" value="{{$album->artworkPath}}">
  </div>

  <input type="submit" name="btnsubmit" value="Update" class="btn-primary">
</form>
</div>
</body>
</html>

@endsection