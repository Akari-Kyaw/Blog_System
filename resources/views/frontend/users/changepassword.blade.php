@extends("layouts.userlayout")

@section('content')



<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">

                <div class="card-body">

                    <h3 class="text-center text-dark fw-bold">{{ ('Change Your Password') }}</h3>

                    <form action="/userprofile/{{$user->id}}/update" method="post">
                        @csrf
                        @method('patch')

                        <div class="col-sm-mt-1">
                            <form method="POST" action="">
                                @csrf
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

                                <div class="row mt-4 mb-3">

                                    <label for="current_password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="current_password" type="password" class="form-control" name="current_password">

                                        @if(session('error'))
                                        <div class="text-danger">
                                            {{session('error')}}
                                        </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="row mb-3">

                                    <label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="new_password" type="password" class="form-control" name="new_password">
                                        @error('new_password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">

                                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Confirm New Password') }}</label>

                                    <div class="col-md-6">

                                        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" autocomplete="new-password">
                                     
                                    </div>
                                </div>



                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info" >
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