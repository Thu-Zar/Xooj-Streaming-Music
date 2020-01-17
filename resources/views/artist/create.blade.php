@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Artist Add Form</h3>

  

	<form method="post" action="{{route('artist.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title" name="name">
    <span class="text-danger">{{ $errors->first('title') }}</span>
  </div>

  <div class="form-group">
    <label for="gen">Gender</label>
    <input type="radio" class="flat" name="gender"  value="Male" id="gen">Male
    <input type="radio" class="flat" name="gender" value="Female" id="gen">Female
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