@extends('layouts.app')

@section('title', 'Create the post')

@section('content')
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('posts.partials.form')
        <div><input type="submit" value={{ __('Create!') }} class="btn btn-primary btn-block"></input></div>
    </form>
@endsection
