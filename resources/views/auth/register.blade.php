@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>{{ __('Name:') }}</label>
            <input name="name" value="{{ old('name') }}" required
                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>{{ __('E-mail') }}</label>
            <input name="email" value="{{ old('email') }}" required
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <label>{{ __('Password') }}</label>
            <input id="password" name="password" type="password" value="{{ old('password') }}" required
                class=" form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label>{{ __('Retype password') }}</label>
            <input name="password_confirmation" type="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
    </form>
@endsection
