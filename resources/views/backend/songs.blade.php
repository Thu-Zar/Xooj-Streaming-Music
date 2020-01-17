@extends('backend.dashboard')
@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="float: left;">DataTables Example</h6>
    <a href="{{route('song.create')}}" style="float: right;" class="btn btn-primary">Add Item</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Duration</th>
            
            
            <th colspan="2" style="text-align: center;">Action</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Duration</th>
             
            
            <th colspan="2" style="text-align: center;">Action</th>
          </tr>
        </tfoot>
        <tbody>
          
            @foreach($songs as $row)
              <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->title}}</td>
                <td>{{$row->duration}}</td>
                <td><a href="{{route('song.edit',$row->id)}}" class="btn btn-info">Edit</a></td>
                <td>
                  <form action="{{route('song.destroy',$row->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <input type="submit" name="" class="btn-primary" value="Delete" onclick="return confirm('Are you sure!')">
        </form>
                  </form>
                </td>
              </tr>
            @endforeach
          

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection