<div class="title-box-d">
    <h3 class="title-d">{{ __('Login') }}</h3>
</div>
<span class="close-box-collapse right-boxed ion-ios-close"></span>
<div class="box-collapse-wrap form">
    <form class="form-a" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label for="email">{{ __('E-Mail') }}</label>
                    <input id="email" type="email"
                        class="form-control form-control-a @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control form-control-a @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-2">
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
            <div class="col-md-12">
                <button type="submit" class="btn btn-b">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>