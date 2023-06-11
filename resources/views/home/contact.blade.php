@extends('layouts.app')

@section('title', 'Contact Page')

@section('content')
    <h1>{{ __('Contact page') }}</h1>
    <p>{{ __('Hello this is contact!') }}</p>

    @can('home.secret')
        <p>
            <a href="{{ route('secret') }}">{{__("Go special contact details!")}}</a>
        </p>
    @endcannot
@endsection
