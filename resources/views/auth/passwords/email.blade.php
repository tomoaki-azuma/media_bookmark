@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center my-3">
    <div class="my-2 text-center function-title">
    Reset Password 
    </div>
</div>

<div class="d-flex justify-content-center my-3">
    <div>
    
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="submit-button">
                パスワード再設定のリンクを送信 
                </button>
            </div>
        </form>
        
    
    </div>

</div>
@endsection
