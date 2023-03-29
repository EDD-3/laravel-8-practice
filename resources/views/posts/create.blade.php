@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{route('posts.store')}}" method="post">
        @csrf
        @method('POST')
        <div><input type="text" name="title" id="title"></div>
        <div><textarea name="content" id="content" cols="30" rows="10"></textarea></div>
        <div><button type="submit">Create Post</button></div>    
    </form>   
@endsection