@extends('layouts.app')
@section('content')
    <div style="padding:10px">
        <h1 style="margin-bottom: 5px">Title: {{$video->title}}</h1>
        <h1 style="margin-bottom: 5px">Body: {{$video->url}}</h1>
        <a href="{{ route('video.create-comment', ['video' => $video->id]) }}" class="btn btn-success" style="margin-bottom: 5px">Add Comments</a>

        @auth
            @if($video->isOwner(\Illuminate\Support\Facades\Auth::user()->id))
                <a href="{{ route('video.edit', ['video' => $video->id]) }}">Edit</a>
            @endif
        @endauth

        <h1>Comments</h1>

        @foreach($video->comments as $comment)
            <p style="margin:5px">
                {{ $comment->comment }}
            </p>
        @endforeach


    </div>
@endsection
