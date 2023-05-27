@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>Contact Page</h1>
    <p>Hello this is Contact</p>

    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">Go Special contact details!</a>
        </p>
    @endcannot
@endsection
