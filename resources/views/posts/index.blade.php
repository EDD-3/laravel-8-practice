@extends('layouts.app')
@section('title', 'Blog Post')
    
@section('content')
{{-- @each('post.partials.post', $post, 'post') --}}

@forelse ($posts as $key => $post)
    @include('posts.partials.post', [])
@empty
    <div class="container"><h1>No posts found!</h1></div> 
@endforelse

@endsection