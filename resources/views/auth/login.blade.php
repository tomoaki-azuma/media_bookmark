@extends('layouts.app')

@section('content')
<div>
    
    <div class="my-2 text-center function-title">
    Login 
    </div>
    
    <div class="mx-2">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4 text-center login-button-wrap">
                    <button type="submit" class="submit-button">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <div class="mt-2">
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-center my-3">
            <div class="btn-group">
                <a href='/login/twitter'>
                <button type="" class="submit-button twitter-login-button">
                <i class="fab fa-twitter mr-2"></i>Sign in with Twitter</button>
                </a>
            </div>
        </div>
        
    </div>
</div>
@endsection

