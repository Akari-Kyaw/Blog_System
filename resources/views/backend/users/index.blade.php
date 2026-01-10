@extends('layout')
@section('content')
<h1>Users</h1>

<div class="d-flex justify-content-between align-items-center">

<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
    
    
          
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <th>{{$user->email}}</th>
            {{-- <td>
                @if($user->is_admin==1)
                {{"Yes"}}
                @else
                {{"No"}}
               @endif

            </td> --}}
            <td class="d-flex">
                <a class="btn btn-sm btn-warning" href="/admin/users/{{$user->id}}">Detail</a>
                
                @if($user->is_admin!=1)

                @if($user->is_banned==0)

                <a class="btn btn-sm btn-info ml-2" href="/admin/users/{{$user->id}}/banned">Ban</a>

                @else

                <a class="btn btn-sm btn-info ml-2" href="/admin/users/{{$user->id}}/banned">Unban</a>

                @endif
                @endif

                @if($user->is_admin!=1)

                <form action="/admin/users/{{$user->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger ml-3">Delete</button>
                </form>

                @endif
                
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