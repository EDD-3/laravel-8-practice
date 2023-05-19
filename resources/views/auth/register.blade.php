@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input name="name" value="{{ old('name') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" value="{{ old('email') }}" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input name="password" required class="form-control">
        </div>
        <div class="form-group">
            <label>Retype Password</label>
            <input name="password_confirmation" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register!</button>
    </form>
@endsection
