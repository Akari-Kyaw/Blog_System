@extends("layouts.userlayout")

@section('content')
<h1 class="text-center">Create New Blog</h1>

<form action="/users/blogs" method="post" enctype="multipart/form-data">
    @csrf
    <label for="title">Title</label>
    <input type="text " class="form-control" name="title" id="title" value="{{old('title')}}">
    @error('title')
    <p class="text-danger">{{$message}}</p>
    @enderror

   <label for="body">Blog</label>
    <textarea class="form-control" name="body" id="body">{{old('body')}}</textarea>
    @error('body')
    <p class="text-danger">{{$message}}</p>
    @enderror 

    <label for="image">Image</label>
    <input type="file" class="form-control" name="image" id="image" accept="/storage/*">
    @error('image')
    <p class="text-danger">{{$message}}</p>
    @enderror

    <label>Category</label>

    <select name="category_id" id="" class="form-control">
        <option value=""selected>Select Here</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}">
            {{$category->name}}
        </option>

        @endforeach
    </select>

        @error('category_id')
        <p class="text-danger">{{$message}}</p>
    @enderror


    <label>Tags</label>
    <select name="tag_ids[]" id="" class="form-control tagmutiple" multiple>
        @foreach($tags as $tag)
        <option value="{{$tag->id}}">
            {{$tag->name}}
        </option>

        @endforeach
    </select>

    <button class="btn btn-success mt-3">Create</button>
    <a href="/users/blogs/index" class="btn btn-primary mt-3">Back</a>
</form>
@section('script')
<script>
    $(document).ready(function() {
    $('.tagmutiple').select2();
});
</script>
@endsection

@endsection