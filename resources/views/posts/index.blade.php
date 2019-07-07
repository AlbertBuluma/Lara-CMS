@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        {{--        <a href="/posts/create" class="btn btn-success float-right">Add Post</a>--}}
        <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Posts</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td><img src="{{ $post->image }}" width="120px" height="60px" alt=""></td>
                            <td>{{ $post->title }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection