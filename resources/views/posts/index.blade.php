@extends('layouts.app')
@section('title', 'Blog Post')
    
@section('content')
@if(count($posts))
@foreach ($posts as $key => $post)
    <div><h1>{{$key}} . {{ $post['title']}} </h1></div>
@endforeach
@else
No posts found!
@endsection