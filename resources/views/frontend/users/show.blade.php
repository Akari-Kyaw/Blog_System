@extends("layouts.userlayout")
@section('content')

<div class="d-flex justify-content-between">

    <h3>{{$blog->title}}</h3>

</div>

<div class="d-flex justify-content-between">
    <h5 class="px-3 py-2 rounded-pill bg-warning">{{$blog->category->name}} </h5>
    <small>
        {{$blog->created_at}}
    </small>

</div>
<div class="d-flex justify-content-center">
    <img src="/storage/{{$blog->image}}" height="300" alt="">
</div>
@foreach($blog->tags as $tag)
<span class="bg-{{$loop->even ? 'success':'primary'}} px-2 py-1 rounded-pill">{{$tag->name}}</span>
@endforeach
<p>{!! nl2br($blog->body)!!}</p>
{{-- <div class="d-flex justify-content-between">
    <div><i class="fa-solid fa-thumbs-up"></i>

        <i class="fa-regular fa-thumbs-up"></i>
    </div>
    <div><i class="fa-solid fa-heart"></i>
        <i class="fa-regular fa-heart"></i>
    </div> --}}
    <div class="d-flex ">
    
            @if($isLike)

            <form action="/userblogs/{{$blog->id}}/unlike" method="post">
                @csrf
                @method('delete')
                <button class="btn pl-0"><i class="fa-solid fa-thumbs-up fa-xl"></i></button>
            </form>

            @else
            <form action="/userblogs/{{$blog->id}}/like" method="post">
                @csrf
                <button class="btn"><i class="fa-regular fa-thumbs-up fa-xl"></i></button>
            </form>
            @endif

            <div class="pt-2">{{ count($blog->likes) }}</div>
        
        @if ($isFavourite)
        <form action="/userblogs/{{$blog->id}}/unfavourite" method="post">
            @csrf
            @method('delete')
            <button class="btn"><i class="fa-solid fa-heart fa-xl"></i></button>
        </form>
        @else
        <form action="/userblogs/{{$blog->id}}/favourite" method="post">
            @csrf
            <button class="btn"><i class="fa-regular fa-heart fa-xl"></i></button>
        </form>
        @endif

    </div>
</div>


<div class="d-flex justify-content-end">
    @auth
    @if($blog->user_id==auth()->user()->id)

    <a href="/users/blogs/{{$blog->id}}/edit" class="btn btn-primary">Edit</a>
    <form action="/users/blogs/{{$blog->id}}" method="post">
        @csrf
        @method('delete')
        <button class="btn btn-danger ms-3">
            Delete
        </button>
    </form>
    @endif
    @endauth
</div>
<div>
    <ul class="list-group">
        <li class="list-group-item active mt-3">
            <b>Comments ({{ count($blog->comments) }})</b>
        </li>

        @foreach($blog->comments as $comment)
        <li class="list-group-item">
            {{ $comment->content }} <div class="small mt-2">
                By <b>{{ $comment->user->name }}</b>,
                {{ $comment->created_at->diffForHumans() }}
            </div>
            @auth
            <div class="float-end d-flex">
                @if($comment->user_id==auth()->user()->id)
                <button type="button" class="btn text-secondary" onclick="showEditForm({{$comment->id}})">Edit</button>
                <form action="/comments/{{$comment->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger ms-3">
                        Delete
                    </button>
                </form>
                @endif
            </div>
            @endauth
        </li>


        <div id="editForm{{$comment->id }}" style="display: none;">
            <form action="/comments/{{$comment->id }}/update" method="post" class="d-inlne">
                @csrf
                @method('patch')
                <input type="hidden" name="comment_id" value="{{$comment->id}}">
                <textarea name="content" id="content"
                    class="form-control">{{old('content')??$comment->content}}</textarea>
                @error('content')
                <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="d-flex">
                    <button class="btn btn-secondary mt-3 mb-3">Update</button>
            </form>
            <button class="btn btn-dark mt-3 mb-3 ms-3" onclick="hideEditForm({{$comment->id}})">Cancel</button>
        </div>
</div>
@endforeach
</ul>
@auth
<form action="/blogs/{{$blog->id }}/comments" method="post">
    @csrf
    <textarea name="content" id="content" class="form-control" placeholder="Enter Your Comment"></textarea>
    @error('content')
    <p class="text-danger">{{message}}</p>
    @enderror
    <button class="btn btn-secondary mt-3 mb-3">Add Comment</button>
</form>
@endauth
<form action="/users/blogs/index">
<button type="button" class="btn btn-dark mb-3" onclick="history.back()">Back</button>
</form>
</div>@section('script')
<script>
    function showEditForm(id){
        console.log(id);
        document.getElementById('editForm'+id).style.display= 'block';
    }
    function hideEditForm(id){
        document.getElementById('editForm'+id).style.display= 'none';
    }
</script>

@endsection
@endsection