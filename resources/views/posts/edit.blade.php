@extends('layouts.app')

@section('title', 'Update the post')

@section('content')
    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('posts.partials.form')
        <div><input type="submit" class="btn btn-primary btn-block" value="{{ __('Update!') }}"></input></div>
    </form>
@endsection
