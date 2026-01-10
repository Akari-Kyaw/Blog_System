@extends('layout')
@section('content')
<h1 class="text-center">Create New Category</h1>
<form action="/categories" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text " class="form-control" name="name" id="name" value="{{old('name')}}">
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror
    <button class="btn btn-success mt-3">Create</button>
    <a href="/categories" class="btn btn-primary mt-3">Back</a>
</form>
@endsection