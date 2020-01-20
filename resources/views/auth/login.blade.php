@extends('layouts.bc')

@section('content')
<div class="container">
    <div class="page-ath-header mb-3">
        <a href="" class="page-ath-logo">
            <img style="width:30%" src="{{ asset('images/logo.png') }}" alt="logo" />
        </a>
    </div>
    <div class="page-ath-form mycard">
        <h2 class="page-ath-heading text-center"><small id="cl2">Sign in to access your dashboard</small></h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-item">
                <input type="text" placeholder="Email" class="input-bordered @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" name="email" autofocus required />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-item">
                <input type="password" placeholder="Password" name="password" class="input-bordered" required />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <div class="input-item text-left">
                    <input class="input-checkbox input-checkbox-md" id="remember-me" type="checkbox" /><label
                        for="remember-me">Remember Me</label>
                </div>
                <div>
                    <a style="text-decoration:none" href="{{ route('password.request') }}" class="cl1">Forgot
                        password?</a>
                    <div class="gaps-2x"></div>
                </div>
            </div>
            <button class="my-btn btn-block">Sign In</button>
        </form>

        <div class="gaps-2x"></div>
        <div class="gaps-2x"></div>
        <div class="form-note" style="color: #7a7a8c">
            Don’t have an account? <a style="text-decoration:none" href="{{ route('register') }}"> <strong
                    class="mylink">Sign up here</strong></a>
        </div>
    </div>
</div>
@endsection
