@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    {{-- Using the dunder method --}}
    <h1>{{ __('messages.welcome') }}</h1>

    {{-- Using the @lang directive --}}
    <h1>@lang('messages.welcome')</h1>

    <p>{{ __('messages.example_with_value', ['name' => 'John']) }}</p>

    <p>{{ trans('messages.plural', 0) }}</p>

    <p>{{ trans('messages.plural', 1) }}</p>

    <p>{{ trans('messages.plural', 2) }}</p>

    <p> Using JSON: {{__('Welcome to Laravel')}}</p>

    <p>{{ __('Hello :name', ['name' => 'John'])}}</p>
@endsection
