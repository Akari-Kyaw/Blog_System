@extends('layout')
@section('content')
<h1 class="text-center">Create New Blog</h1>

<div class="container">
    <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <label for="body">Blog</label>
        <textarea class="form-control" name="body" id="body">{{ old('body') }}</textarea>
        @error('body')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <label for="body">Image</label>

        <input type="file" class="form-control" name="image" id="image" onchange="previewImage(event)" accept="image/*">
        <img id="preview" src="" alt="preview" style="display:none; max-height:200px; margin-top:10px;">

        <script>
            function previewImage(event) {
                const preview = document.getElementById('preview');
                preview.src = URL.createObjectURL(event.target.files[0]);
                preview.style.display = 'block';
            }
        </script>


        <label>Category</label>
        <select name="category_id" class="form-control">
            <option value="" selected>Select Here</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <label>Tags</label>
        <select name="tag_ids[]" class="form-control tagmutiple" multiple>
            @foreach($tags as $tag)
            <option value="{{ $tag->id }}" {{ collect(old('tag_ids'))->contains($tag->id) ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
            @endforeach
        </select>

        <div>
            <button class="btn btn-success mt-3">Create</button>
            <a href="/blogs" class="btn btn-primary mt-3">Back</a>
        </div>
    </form>
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('.tagmutiple').select2();
    });
</script>
@endsection
@endsection