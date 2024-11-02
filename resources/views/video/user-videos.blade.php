@extends('layouts.app')
@section('content')
    <div>
        <a href="{{route('video.create')}}" class="btn btn-success">Create video</a>
    </div>

    <div class="container" style="padding: 10px">
        <div class="container">
            <h1>Videos</h1>
            <div class=" d-flex flex-wrap">
                @foreach($videos as $video)
                    <div class="card" style="width: 18rem;margin:2px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Video: {{ $video->url }}</h6>
                            <a href="{{route('video.show', ['video' => $video->id])}}" class="card-link">View</a>
                            <a href="{{route('video.edit', ['video' => $video->id])}}" class="card-link">Edit</a>

                        </div>
                    </div>
                @endforeach
            </div>

            {{ $videos->links() }}

        </div>
@endsection
