@extends('layouts.app')
@section('content')
    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <h1>Create Comment</h1>
    <form action="{{ route('video.store-comment') }}" method="post" style="padding: 10px">
        @csrf
        <label for="">
            Comment
        </label>
        <br>
        <input type="text" name="comment" class="form-control" value="{{old('comment')}}" placeholder="Comment">
        <input type="hidden" name="video_id" class="form-control" value="{{ $video_id }}" placeholder="Comment">
        <br>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button class="btn btn-success" type="submit">Create</button>
    </form>
@endsection
