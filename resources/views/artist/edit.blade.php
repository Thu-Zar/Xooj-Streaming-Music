@extends('backend.dashboard')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title>Show Table</title>
</head>
<body>
	<div class="container justify-content-center">
	<h3 class="text-center">Artist Edit Form</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

	<form method="post" action="{{route('artist.update',$artist->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$artist->name}}">
  </div>

  <div class="form-group">
  	<input type="radio" class="flat" name="gender"  value="{{$artist->gender}}"
       {{ $artist->gender == 'Male' ? 'checked' : '' }} >Male

	<input type="radio" value="{{$artist->gender}}" class="flat" name="gender"
       {{ $artist->gender == 'Female' ? 'checked' : '' }} >Female
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Artist Photo
      <span class="text-danger">[support file types:jpeg,png,jpg]</span>
      <input type="file" name="photo">
    </label>
    <img src="{{asset($artist->photo)}}" class="img-fluid w-25">
    <input type="hidden" name="oldphoto" value="{{$artist->photo}}">
  </div>
    
  </div>
  <input type="submit" name="btnsubmit" value="Update" class="btn-primary">
</form>
</div>
</body>
</html>

@endsection