@extends('layouts.app')
@section('content')
    <h1>Edit Video</h1>
    <form action="{{ route('video.update', ['video' => $video]) }}" method="post" style="padding: 10px">
        @csrf
        @method('PUT')
        <label for="">
            Title
        </label>
        <br>
        <input type="text" name="title" class="form-control" value="{{ old('title') ?? $video->title }}" placeholder="Title">
        <br>
        <label for="">Url</label>
        <br>
        <input type="text" name="url" class="form-control" value="{{ old('url') ?? $video->url }}" placeholder="Url">
        <input type="hidden" name="video" class="form-control" value="{{$video->id}}">
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
