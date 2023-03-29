@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form action="{{route('posts.update', ['post' => $post->id ])}}" method="post">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div><button type="submit">Update Post</button></div>    
    </form>   
@endsection