@extends('layout')
@section('content')




@if($is_banned->isEmpty())
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <h2 class="card-header">{{"Ban User List"}}</h2>

                <div class="card-body">

                    <h5 class="">{{"No users are banned"}}</h5>

                </div>
            </div>
        </div>
    </div>
</div>
@else

<!-- /.card-header -->

<h1>Ban User Lists</h1>

<div class="card">

    <div class="card-body">
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>


                @foreach($is_banned as $banned)
                <tr>
                    <td>{{$banned->id}}</td>
                    <td>{{$banned->name}}</td>
                    <td>{{$banned->email}}</td>
                    <td>
                        @if($banned)
                        <form action="/admin/users/{{$banned->id}}/unbanned" method="post">
                            @csrf
                            @method('put')
                            <button class="btn btn-info" type="submit">Unban</button>
                        </form>
                        @endif
                    </td>
                </tr>

                @endforeach
                @endif


                <tr>

                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection

@section('script')
<script>
    $('table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
</script>
@endsection