@extends('layouts.app')
@section('title', 'Blog Post')

@section('content')
    {{-- @each('post.partials.post', $post, 'post') --}}
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $key => $post)
                @include('posts.partials.post', [])
            @empty
                <div class="container">
                    <h1>No posts found!</h1>
                </div>
            @endforelse
        </div>
        <div class="col-4">

            @include('posts.partials.activity')


        </div>
    </div>


@endsection