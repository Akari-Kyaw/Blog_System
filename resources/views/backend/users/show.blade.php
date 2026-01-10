@extends('layout')
@section('content')

<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <h3 class="card-header text-center">
                    {{"User Detail"}}
                </h3>

                <div class="card-body name">
                    <div class="">Name : {{$user->name}}</div>
                    <div class="mt-3">Email : {{$user->email}}</div>
                    <div class="mt-3">Banned : {{ $user->is_banned }}</div>
                    <div class="mt-3">Created_at : {{ $user->created_at }}</div>

                    <div class="d-flex flex-end">
                        <a class="btn btn-dark mt-3" href="/admin/users">Back</a>

                    </div>


                </div>



            </div>
        </div>
    </div>

</div>

@endsection