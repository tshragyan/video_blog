@extends('layouts.app')
@section('content')
    <div>
        <a href="{{route('post.create')}}" class="btn btn-success">Create Post</a>
    </div>

    <div class="container" style="padding: 10px">
        <div class="container">
            <h1>Posts</h1>
            <div class=" d-flex flex-wrap">
                @foreach($posts as $post)
                    <div class="card" style="width: 18rem;margin:2px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Video: {{ $post->body }}</h6>
                            <a href="{{route('post.show', ['post' => $post->id])}}" class="card-link">View</a>
                            <a href="{{route('post.edit', ['post' => $post->id])}}" class="card-link">Edit</a>

                        </div>
                    </div>
                @endforeach
            </div>

            {{ $posts->links() }}

        </div>
@endsection
