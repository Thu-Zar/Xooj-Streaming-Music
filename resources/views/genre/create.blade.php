@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Genre Add Form</h3>

	<form method="post" action="{{route('genre.store')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title" name="name">
    <span class="text-danger">{{ $errors->first('name') }}</span>
  </div>
  <input type="submit" name="btnsubmit" value="Save" class="btn-primary">
</form>
</div>
</body>
</html>

@endsection