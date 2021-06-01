@extends('layouts.app')

@section('title','Malaipace | Login')

@section('Login','active')

@section('content')
<main id="main">
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 offset-md-6 col-lg-8 offset-lg-6">
                    <div class="title-single-box">
                        <h1 class="title-single">Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Blog Single ======= -->
    <section class="news-single nav-arrow-b">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12 offset-md-6 offset-lg-6">
                    <div class="form-comments">
                        <!--
                        <div class="title-box-d">
                            <h3 class="title-d"> Register</h3>
                        </div>
                        -->
                        <form class="form-a" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="email">{{ __('E-Mail') }}</label>
                                        <input id="email" type="email"
                                            class="form-control form-control-lg form-control-a @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password"
                                            class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-b">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<!-- End Blog Single-->
@endsection

