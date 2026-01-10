@extends("layouts.userlayout")

@section("content")
<div class="container pt-4">
    
    <h2>Favourite Lists</h2>

    @forelse($favourites as $favourite)
        <div class="card mb-2 colour">
            <div class="card-body">
                <h5 class="card-title">
                    <b>{{ $favourite->blog->title }}</b>
                </h5>

                <div class="card-text mb-2 pt-2 text-muted small">
                    By <b>{{ $favourite->blog->user->name }}</b>,
                    Category: <b>{{ $favourite->blog->category->name }}</b>
                </div>

                <p class="card-text">
                    {{ substr($favourite->blog->body, 0, 450) }}.....
                </p>

                <a class="card-link" href="/users/blogs/{{ $favourite->blog->id }}">
                    View Detail &raquo;
                </a>
            </div>
        </div>

    @empty
        <div class="alert alert-info text-center mt-3">
            No favourite list found.
        </div>
    @endforelse

    <a href="/users/profile/index" class="btn btn-primary mt-3">Back</a>

</div>
@endsection
