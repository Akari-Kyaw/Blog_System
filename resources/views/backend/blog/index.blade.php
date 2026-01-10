@extends('layout')
@section('content')

<div class="d-flex justify-content-between align-items-center">
<h1>Blog</h1>
<a href="{{route('blogs.create')}}" class="btn btn-success ">Create New Blog</a>
</div>
{{-- <table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Category</th>
      <th scope="col">Action</th>


      
    </tr>
  </thead>
  <tbody>
    @foreach($blogs as $blog)
    <tr>
      <th scope="row">{{$blog->id}}</th>
      <td>{{$blog->title}}</td>
      <td><img src="/storage/{{$blog->image}}" alt="" width="200"></td>
      <td>{{$blog->Category->name}}</td>

      <td class="d-flex">
        <a href="{{route('blogs.show',$blog->id)}}" class="btn btn-success mr-3">Detail</a>
        <a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-secondary">Edit</a>
      <form action="{{route('blogs.destroy',$blog->id)}}" method="post">
        @csrf
        @method('delete')
      <button class=" btn btn-danger ml-3">Delete</button>
      </form></td>
    </tr>
    @endforeach
  </tbody>
</table> --}}
<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Image</th>
        <th scope="col">Category</th>
        <th scope="col">Action</th>
  
  
        
      </tr>
    </thead>
    <tbody>
      @foreach($blogs as $blog)
      <tr>
        <th scope="row">{{$blog->id}}</th>
        <td>{{$blog->title}}</td>
        <td><img src="/storage/{{$blog->image}}" alt="" width="200"></td>
        <td>{{$blog->Category->name}}</td>
  
        <td class="d-flex">
          <a href="{{route('blogs.show',$blog->id)}}" class="btn btn-success mr-3">Detail</a>
          <a href="{{route('blogs.edit',$blog->id)}}" class="btn btn-secondary">Edit</a>
        <form action="{{route('blogs.destroy',$blog->id)}}" method="post">
          @csrf
          @method('delete')
        <button class=" btn btn-danger ml-3">Delete</button>
        </form></td>
      </tr>
      @endforeach
    </tbody>
    
  </table>
</div>
@endsection
@section('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection