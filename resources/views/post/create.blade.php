@extends('layouts.app')
@section('content')
    <h1>Create Post</h1>
        <form action="{{ route('post.store') }}" method="post" style="padding: 10px">
            @csrf
            <label for="">
                Title
            </label>
            <br>
            <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Title">
            <br>
            <label for="">Body</label>
            <br>
            <input type="text" name="body" class="form-control" value="{{old('body')}}" placeholder="Body">
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
