@extends('layout')
@section('content')
<h1 class="text-center">Create New Tag</h1>
<div class="container">
<form action="/tags" method="post">
    @csrf
    <label for="name">Name</label>
    <input type="text " class="form-control" name="name" id="name" value="{{old('name')}}">
    @error('name')
    <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="mt-3">
        <button class="btn btn-success">Create</button>
    <a href="/tags" class="btn btn-primary">Back</a>
    </div>
</form>
</div>

@endsection