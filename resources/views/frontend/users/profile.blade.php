@extends("layouts.userlayout")
@section("content")
<div class="container">
    @foreach($users as $user)
    @auth
    @if($user->id==auth()->user()->id)
    <div class="card mb-2 ">
        <div class="card-body">
            <h1 class="card-title">{{$user->name}}</h1>
            <p>
                Email : {{$user->email}}
            </p>
            <p>
                Number of Blogs : {{ count($user->blogs) }}
            </p>
            <div class="d-flex justify-content-between mt-4">

                <!-- <a class="btn text-white" href="/userprofile/{{$user->id}}/edit" style="background-color: #3C5B6F;">Change Password</a> -->
                
                <a class="btn text-white" href="/userprofile/{{$user->id}}/profileedit" style="background-color: #4D869C;">Edit Profile</a>
            </div>
        </div>
        @auth
        @foreach(auth()->user()->blogs as $blog)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $blog ->title }}</h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{-- by <b>{{$blog->user->name}}</b> --}}
                    {{ $blog->created_at->diffForHumans() }}
                </div>
                <img src="/storage/{{ $blog->image }}" alt="" height="400px">
                <p class="card-text">{{ substr(($blog->body),0,200) }}...........</p>
                <a class="card-link" href="/users/blogs/{{$blog->id}}">
                    View Detail &raquo;
                </a>
            </div>
        </div>
        @endforeach
        @endauth
        <form action="/users/blogs/index">
            <button type="button" class="btn btn-dark" onclick="history.back()">Back</button>
            </form>
    </div>
    @endif
    @endauth
    @endforeach
</div>
@endsection