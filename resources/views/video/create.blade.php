@extends('layouts.app')
@section('content')
    <h1>Create Video</h1>
        <form action="{{ route('video.store') }}" method="POST" style="padding: 10px">
            @csrf
            <label for="">
                Title
            </label>
            <br>
            <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Title">
            <br>
            <label for="">Url</label>
            <br>
            <input type="text" name="url" class="form-control" value="{{old('url')}}" placeholder="Url">
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
