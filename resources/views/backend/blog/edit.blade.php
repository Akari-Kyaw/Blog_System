@extends('layout')
@section('content')
<h1 class="text-center">Edit Blog</h1>

<form action="{{route('blogs.update',$blog->id)}}" method="post" enctype="multipart/form-data">
    @method ('patch')
    @csrf
    <label for="title">Title</label>
    <input type="text " class="form-control" name="title" id="title" value="{{old('title')  ?? $blog -> title}} ">
    @error('title')
    <p class="text-danger">{{$message}}</p>
    @enderror

   <label for="body">Blog</label>
    <textarea class="form-control" name="body" id="body">{{old('body') ?? $blog -> body}}</textarea>
    @error('body')
    <p class="text-danger">{{$message}}</p>
    @enderror 

    <label for="image">Image</label> <br>
    <img src="/storage/{{$blog->image}}" alt="blogs image" width="200">
    <input type="file" class="form-control mt-3" name="image" id="image" accept="image/*">
    @error('image')
    <p class="text-danger">{{$message}}</p>
    @enderror

    <label>Category</label>

    <select name="category_id" id="" class="form-control">
        {{-- <option value=""selected>Select Here</option> --}}
        @foreach($categories as $category)
        <option value="{{$category->id}}" {{old('category_id')== $category->id || (!old('category_id') && $blog->category->id==$category->id) ? 'selected':''}}>{{$category->name}}</option>

        @endforeach
    </select>

        @error('category_id')
        <p class="text-danger">{{$message}}</p>
    @enderror


    <label>Tags</label>
    <select name="tag_ids[]" id="" class="form-control tagmutiple" multiple>
        @foreach($tags as $tag)
        <option value="{{$tag->id}}" {{in_array($tag->id,old('tag_ids')?? [])||(!old('tag_ids') && $blog->tags->pluck('id')->contains($tag->id)) ? 'selected' :   ''}}> 
            {{$tag->name}}
        </option>

        @endforeach
    </select>

    <button class="btn btn-success mt-3">Edit</button>
    <a href="/blogs" class="btn btn-primary mt-3">Back</a>
</form>
@section('script')
<script>
    $(document).ready(function() {
    $('.tagmutiple').select2();
});
</script>
@endsection

@endsection