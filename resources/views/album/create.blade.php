@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Album Add Form</h3>

  

	<form method="post" action="{{route('album.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title" name="title">
    <span class="text-danger">{{ $errors->first('title') }}</span>
  </div>

  <div class="form-group">
    <label>Artist</label>
    <select name="artist" class="form-control">
      <option value="">Choose Artist</option>
      {-- accept data and loop --}
      @foreach($artists as $row)
      <option value="{{$row->id}}">{{$row->name}}</option>
      @endforeach
    </select>
    <span class="text-danger">{{ $errors->first('artist') }}</span>
  </div>

  <div class="form-group">
    <label>Genre</label>
    <select name="genre" class="form-control">
      <option value="">Choose Genre Type</option>
      {-- accept data and loop --}
      @foreach($genres as $row)
      <option value="{{$row->id}}">{{$row->name}}</option>
      @endforeach
    </select>
    <span class="text-danger">{{ $errors->first('artist') }}</span>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">Photo
      <span class="text-danger">[support file types:mp3]</span>
      <span class="text-danger">{{ $errors->first('path') }}</span>
    </label>
    <input type="file" name="photo">
  </div>
  <input type="submit" name="btnsubmit" value="Save" class="btn-primary">
</form>
</div>

</body>
</html>

@endsection