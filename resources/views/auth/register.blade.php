@extends('layouts.bc')

@section('content')
<div class="container">
    <div class="page-ath-header">
        <a href="/" class="page-ath-logo"><img src="" srcset=""
                alt="logo" /></a>
    </div>
    <div class="page-ath-form mycard">
        <h2 class="page-ath-heading method1 text-center"><small id="cl2">Sign up to xxx-xxxx</small></h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="input-item">
                <input type="text" placeholder="Fullname" name="name" class="input-bordered" />
            </div>
            <div class="input-item">
                <input type="text" placeholder="Phone" class="input-bordered" name="phone" required/>
            </div>
            <div class="input-item">
                <input type="email" placeholder="Email" class="input-bordered @error('email') is-invalid @enderror" name="email" required/>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-item">
                <input type="password" placeholder="Password" class="input-bordered @error('password') is-invalid @enderror" name="password" required />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-item">
                <input type="password" placeholder="Confirm Password" name="password_confirmation" required class="input-bordered" />
            </div>
            <button class="my-btn btn-block">Sign In</button>
        </form>

        <div class="gaps-2x"></div>
        <div class="gaps-2x"></div>
        <div class="form-note" style="color: #7a7a8c">
            Already have an account? <a style="text-decoration:none" href="{{ route('login') }}"> <strong class="mylink">Sign in here</strong></a>
        </div>
    </div>
</div>
@endsection
