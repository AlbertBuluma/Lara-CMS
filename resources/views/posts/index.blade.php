@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        {{--        <a href="/posts/create" class="btn btn-success float-right">Add Post</a>--}}
        <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Post</a>
    </div>
@endsection