@extends('layouts.app')
@section('content')
    <h1>Edit Post</h1>
    <form action="{{ route('post.update', ['post' => $post]) }}" method="post" style="padding: 10px">
        @csrf
        @method('PUT')
        <label for="">
            Title
        </label>
        <br>
        <input type="text" name="title" class="form-control" value="{{ old('title') ?? $post->title }}" placeholder="Title">
        <br>
        <label for="">Body</label>
        <br>
        <input type="text" name="body" class="form-control" value="{{ old('body') ?? $post->body }}" placeholder="Body">
        <input type="hidden" name="post" class="form-control" value="{{$post->id}}">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="btn btn-success" type="submit">Edit</button>
    </form>
@endsection
