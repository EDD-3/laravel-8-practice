@extends('layouts.app')
@section('title', 'Blog Post')
    
@section('content')

@forelse ($posts as $key => $post)
    @include('posts.partials.post')
@empty

    <div><h1>No posts found!</h1></div> 
@endforelse

@endsection