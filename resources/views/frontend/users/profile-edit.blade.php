@extends("layouts.userlayout")


@section('content')



<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">

                <div class="card-body">

                    <h3 class="text-center text-dark fw-bold">{{ ('Edit Your Profile') }}</h3>

                    <form action="/userprofile/{{$user->id}}/profileupdate" method="post">
                        @csrf
                        @method('patch')

                        <div class="col-sm-mt-1">
                            <form method="POST" action="">
                                @csrf

                                <div class="row mb-3 mt-4">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name')  ?? $user->name }}">

                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">

                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-4 mb-4">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-info">
                                            {{ __('Update') }}
                                        </button>

                                        <a href="/users/profile/index" class="btn btn-dark">Back</a>
                                    </div>

                                </div>
                            </form>

                        </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection