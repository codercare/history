@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="login-box">
                <div class="login-logo">
                    <a href="/home">
                        <!-- <b>Bhandari </b>Bansawali -->
                        <img src="images/bhandari.png" style="width:100px; height:100px;">
                    </a>

                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Sign in to start bansawali system</p>

                        <form method="POST" action="{{ route('login') }}" autocomplete="off">
                            @csrf
                            <div class="input-group mb-3">
                                <input id="login" type="text" class="form-control  @error('login') is-invalid @enderror"
                                    name="login" value="{{ old('login') }}" placeholder="{{ __('E-Mail or Mobile') }}"
                                    autocomplete="off" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input id="password" type="password" placeholder="{{ __('Password') }}"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            <a href="auth/github" class="btn  btn-warning btn-block btn-github"><i
                                    class="fab fa-github"></i> Sign in with <b>Github</b></a>
                            <a href="auth/facebook" class="btn btn-primary btn-block"><i class="fab fa-facebook"></i>
                                Sign in with <b>Facebook</b></a>
                            <!-- <a href="auth/twitter" class="btn btn-info btn-block"><i class="fab fa-twitter"></i> Sign in with <b>Twitter</b></a> -->
                            <a href="auth/google" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Sign in
                                with <b>Google</b></a>
                        </div>
                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            @if (Route::has('password.request'))
                                <a  href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                           
                        </p>
                        <p class="mb-0">
                            <a href="{{url('/register')}}" class="text-center">Register a new membership</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection