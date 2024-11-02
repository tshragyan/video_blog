@extends('layouts.app')

@section('content')
    <div class="container" style="padding: 10px">
        <div class="container">
            <h1>Videos</h1>
            @foreach($videos as $video)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Video: {{ $video->url }}</h6>
                        <a href="#" class="card-link">Add Comment</a>
                        <a href="#" class="card-link">View Comments</a>
                    </div>
                </div>
            @endforeach
            {{ $videos->links() }}
        </div>
        <div class="container">
            <h1>Posts</h1>
            @foreach($posts as $post)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Video: {{ $post->body }}</h6>
                        <a href="#" class="card-link">Add Comment</a>
                        <a href="#" class="card-link">View Comments</a>
                    </div>
                </div>
            @endforeach
            {{ $posts->links() }}

        </div>
@endsection
