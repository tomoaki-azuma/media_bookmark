@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email による認証</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                             新たに認証コードを再送しましたのでご確認ください。 
                        </div>
                    @endif

                    Email に認証用のリンクを送りました。ご確認ください。
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">再度送信する。</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
