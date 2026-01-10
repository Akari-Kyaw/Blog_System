@extends('layout')
@section('content')
<h1 class="text-center">Edit Category</h1>
<form action="{{route('categories.update', $category->id)}}" method="post">
    @csrf
   @method('patch')
<label for="name">Name</label>
<input type="text " class="form-control" name="name" id="name" value="{{old('name') ?? $category->name}}">
@error('name')
<p class="text-danger">{{$message}}</p>
@enderror
<button class="btn btn-success mt-3">Update</button>
<a href="/categories" class="btn btn-primary mt-3">Back</a>
</form>
@endsection