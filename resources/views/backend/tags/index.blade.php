@extends('layout')
@section('content')
<div class="d-flex justify-content-between align-items-center">
  <h1>Tags</h1>
  <a href="/tags/create" class="btn btn-success ">Create New Tag</a>
</div>
{{-- <table class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>

    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr>
      <th scope="row">{{$category->id}}</th>
      <td>{{$category->name}}</td>
      <td class="d-flex"><a href="/categories/{{ $category->id }}/edit" class="btn btn-secondary">Edit</a>
        <form action="/categories/{{$category->id}}" method="post">
          @csrf
          @method('delete')
          <button class=" btn btn-danger ml-3">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table> --}}
<div class="card-body">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Action</th>
        
      </tr>
    </thead>
    <tbody>
      @foreach($tags as $tag)
      <tr>
        <th scope="row">{{$tag->id}}</th>
        <td>{{$tag->name}}</td>
        <td class="d-flex"><a href="/tags/{{ $tag->id }}/edit" class="btn btn-secondary">Edit</a>
          <form action="/tags/{{$tag->id}}" method="post">
            @csrf
            @method('delete')
            <button class=" btn btn-danger ml-3">Delete</button>
          </form>
        </td>
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