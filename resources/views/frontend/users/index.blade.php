@extends("layouts.userlayout")

@section('content')

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Blog
          <small>Home</small>
        </h1>

        <!-- Blog Post -->
        @foreach($blogs as $blog)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $blog ->title }}</h5>
                <div class="d-flex justify-content-between">
                    <h5 class="px-3 py-2 rounded-pill bg-warning">{{$blog->category->name}} </h5>
                    <small>
                        {{$blog->created_at}}
                    </small>
                
                </div>
                <div class="card-subtitle mb-2 text-muted small">
                    by <b>{{$blog->user->name}}</b>
                    {{ $blog->created_at->diffForHumans() }}
                </div>
                <img src="/storage/blogs/{{ $blog->image }}" alt="" height="400px" >
                 <!-- <img src="/storage/blogs/eyeliner.jpg" alt=""> -->
                <p class="card-text">{{substr(($blog->body),0,100 ) }}..........</p>
                <a class="card-link btn btn-primary" href="/users/blogs/{{$blog->id}}">
                    View Detail &raquo;
                </a>
            </div>
        </div>
        @endforeach
        
{{$blogs->links()}}
       

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <form action="{{url('/users/blogs/index')}}" method="post">
              @csrf
              <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for...">
                <span class="input-group-append">
                  <button class="btn btn-secondary" type="submit">Go!</button>
                </span>
              </div>
            </form>
          </div>
        </div>

        <!-- Categories Widget -->
        <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col">
    
                  <ul class="list-unstyled mb-0">
    
                    @foreach($categories as $category)
    
                    <form action="{{url('/users/blogs/index/'.$category->id.'')}}" method="get">
    
    
                      <button class="btn button {{(request('category_id') == $category->id) ? 'active' : ''}}" type="submit">{{$category->name}}</button>
    
                    </form>
    
                    @endforeach

    
                  </ul>
    
                </div>
              </div>
            </div>

          </div>

        <!-- Side Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div> -->
    <!-- /.row -->

  </div>
  <!-- /.container -->
  @endsection


