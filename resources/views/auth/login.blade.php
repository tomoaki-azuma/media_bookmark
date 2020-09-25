@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center my-3">
    <div class="my-2 text-center function-title">
    Login 
    </div>
</div>

<div class="d-flex justify-content-center my-3">
    <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail') }}</label>

        <div class="">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

        <div class="">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div>

    <div class="text-center login-button-wrap">
        <button type="submit" class="submit-button">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
            <div class="mt-2 login-link">
            <a class="" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            </div>
        @endif
    </div>
    </form>
</div>
<div class="d-flex justify-content-center my-3">
    <div class="btn-group">
        <a href='/login/twitter'>
        <button type="" class="submit-button twitter-login-button">
        <i class="fab fa-twitter mr-2"></i>Sign in with Twitter</button>
        </a>
    </div>
</div>
@endsection

