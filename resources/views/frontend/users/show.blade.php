@extends("layouts.userlayout")
@section('content')

<div class="container mt-2">
    <div class="d-flex justify-content-between">

        <h3>{{$blog->title}}</h3>

    </div>

    <div class="d-flex justify-content-between ">
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
    <p class="m-3">{!! nl2br($blog->body)!!}</p>

    <div class="d-flex row justify-content-between m-4 align-items-center">
        <div class="d-flex align-items-center gap-3">

            @if($isLike)

            <form action="/userblogs/{{$blog->id}}/unlike" method="post">
                @csrf
                @method('delete')
                <button class="btn"><i class="fa-solid fa-thumbs-up fa-xl"></i></button>
            </form>

            @else
            <form action="/userblogs/{{$blog->id}}/like" method="post">
                @csrf
                <button class="btn"><i class="fa-regular fa-thumbs-up fa-xl"></i></button>
            </form>
            @endif

            <span class="fw-semibold">{{ $blog->likes->count() }}</span>

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

        <div class="d-flex justify-content-end mb-3">
            @auth
            @if($blog->user_id==auth()->user()->id)

            <div class="mr-4">
                <a href="/users/blogs/{{$blog->id}}/edit" class="btn btn-primary">Edit</a>

            </div>
            <div class="mr-3">
                <form action="/users/blogs/{{$blog->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger ms-3">
                        Delete
                    </button>
                </form>
            </div>
            @endif
            @endauth
        </div>
    </div>

    <div class="m-3">
        <ul class="list-group">
            <li class="list-group-item active mt-3">
                <b>Comments ({{ count($blog->comments) }})</b>
            </li>
            @foreach($blog->comments as $comment)
            <li class="list-group-item">
                {{ $comment->content }}
                <div class="small mt-2">
                    By <b>{{ $comment->user->name }}</b>,
                    {{ $comment->created_at->diffForHumans() }}
                </div>
                @auth
                <div class="d-flex justify-content-end">
                    @if($comment->user_id==auth()->user()->id)
                    <form action="/comments/{{$comment->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger ms-3 mt-2">
                            Delete
                        </button>
                    </form>
                    @endif
                </div>
                @endauth

                <div id="editForm{{ $comment->id }}" style="display: none;">
                    <form action="/comments/{{$comment->id }}/update" method="post">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <textarea name="content" id="content" class="form-control">{{ old('content') ?? $comment->content }}</textarea>
                        @error('content')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="d-flex">
                            <button type="submit" class="btn btn-secondary mt-3 mb-3">Update</button>
                        </div>
                    </form>
                    <button class="btn btn-dark mt-3 mb-3 ms-3" onclick="hideEditForm('{{ $comment->id }}')">Cancel</button>
                </div>
            </li>
            @endforeach
    </ul>

    </div>

    @auth
    <form action="/blogs/{{$blog->id }}/comments" method="post">
        @csrf
        <textarea name="content" id="content" class="form-control" placeholder="Enter Your Comment"></textarea>
        @error('content')
        <p class="text-danger">{{$message}}</p>
        @enderror
        <div class="d-flex justify-content-between align-items-center m-3">
            <button type="submit" class="btn btn-primary">Add Comment</button>
            <a href="javascript:history.back()" class="btn btn-dark">Back</a>
        </div>
    </form>
    @endauth

</div>

@endsection

@section('script')
<script>
    function showEditForm(id) {
        document.getElementById('editForm' + id).style.display = 'block';
    }

    function hideEditForm(id) {
        document.getElementById('editForm' + id).style.display = 'none';
    }
</script>

@endsection