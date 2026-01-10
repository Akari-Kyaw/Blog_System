@extends('layout')
@section('content')
<h3>{{$blog->title}}</h3>
<div class="d-flex justify-content-between">
    <h5 class="px-3 py-2 rounded-pill bg-warning">{{$blog->category->name}} </h5>
    <small>
        {{$blog->created_at}}
    </small>

</div>
<div class="d-flex justify-content-center" >
<img src="/storage/{{$blog->image}}" height="300" alt=""></div>
@foreach($blog->tags as $tag)
<span class="bg-{{$loop->even ? 'success':'primary'}} px-2 py-1 rounded-pill">{{$tag->name}}</span>
@endforeach
<p>{!! nl2br($blog->body)!!}</p>


<div class="d-flex justify-content-end">

    <a href="{{route('blogs.edit',$blog->id)}} " class="btn btn-primary">Edit</a>

    <a href="{{route('blogs.index')}} " class="btn btn-secondary ml-3">back</a>
</div>


@endsection                                                                                             