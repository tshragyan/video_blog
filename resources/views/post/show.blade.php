@extends('layouts.app')
@section('content')
    <div style="padding:10px">
        <h1 style="margin-bottom: 5px">Title: {{$post->title}}</h1>
        <h1 style="margin-bottom: 5px">Body: {{$post->body}}</h1>
        <a href="{{ route('post.create-comment', ['post' => $post->id]) }}" class="btn btn-success" style="margin-bottom: 5px">Add Comments</a>

        @auth
            @if($post->isOwner(\Illuminate\Support\Facades\Auth::user()->id))
                <a href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
            @endif
        @endauth

        <h1>Comments</h1>

        @foreach($post->comments as $comment)
            <p style="margin:5px">
                {{ $comment->comment }}
            </p>
        @endforeach


    </div>
@endsection
