@extends('layouts.app')

@section('ogp-matadata')
<meta property="og:title" content="Media Bookmark|メディアブックマーク">
<meta property="og:description" content="Media Bookmark（メディアブックマーク）は自分の気に入った画像、動画、HPなど様々なコンテンツをブックマークとして登録し、QRコードやSNS（Twitter,LINE,FaceBook)でシェアするためのサービスです。">
<meta property="og:image" content="{{ asset('storage').'/common/toplogo.png' }}">
@endsection

@section('content')
<div class="d-flex justify-content-center my-3">
    @auth
        <a href="{{ url('/home') }}">
        <button type="" class="submit-button">
        Login</button>
        </a>
    @else
        <div class="text-center">
            <div>
                <a href="{{ route('login') }}">
                <button type="" class="submit-button">
                Login</button>
                </a>
            </div>
            <div class="register-text">
                <a class="mx-1" href="{{ route('register') }}">新規会員登録する</a>
            </div>
        </div>
    @endauth
</div>
<div class="d-flex justify-content-center my-3">
    <div class="btn-group">
        <a href='/login/twitter'>
        <button type="" class="submit-button twitter-login-button">
        <i style="color: white" class="fab fa-twitter mr-2"></i>Sign in with Twitter</button>
        </a>
    </div>
</div>

<div class="d-flex justify-content-center my-3">
    <div class="btn-group">
        <a href='/login/google'>
        <button type="" class="submit-button twitter-login-button">
        <i style="color: white" class="fab fa-google mr-2"></i>Sign in with Google</button>
        </a>
    </div>
</div>

<div class="d-flex justify-content-center">
    <div class="mx-3 mt-3 bookmark-card">
        <div class="home-card-title py-0 px-2">Media Bookmarkとは？</div>
        <div class="home-card-text p-3">
            Media Bookmarkは自分の好きなコンテンツのブックマークを作成し、世界中の人と共有できるサービスです。<br>
            あなたの好きなHP、ブログ、動画、画像あらゆるメディアへのリンクを自分のお気に入りを書いたカードを配るような感覚で共有することができます。
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="mx-3 mt-3 bookmark-card">
        <div class="home-card-title py-0 px-2">特徴</div>
        <div class="home-card-text p-3">
            <div>
                <div class="home-card-subtitle">簡単登録</div>
                <div>
                    ブックマークへのリンクの登録はurlをコピーするだけ。タイトルや詳細情報、サムネイルは自動で取得します。
                </div>
            </div>
            <div class="mt-3">
                <div>登録無料</div>
                <div>
                ユーザー登録をしていただければ無料にて利用できます。
                ユーザ登録はメールアドレスまたはSNSアカウントにてできます。
                </div>
            </div>
            <div class="mt-3">
                <div>多様なシェア方法</div>
                <div>
                ブックマークの共有は各種SNS、QRコード、URLリンクのコピーにより簡単に行えます。<br>ブックマークの共有先は本サービスのユーザである必要はなく、多くの人に共有してもらうことができます。
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="mx-3 mt-3 bookmark-card">
        <div class="home-card-title py-0 px-2">デモンストレーション</div>
        <div class="home-card-text p-3">
            <div class="mt-1">
                <div>
                百聞は一見に如かず。実際にデモを見てもらったほうがよいかもしれません。<br>
                以下のQRコードまたはリンクから実際にシェアされるMedia Bookmarkとデモ動画をご覧ください。
                </div>
            </div>
        </div>
    </div>
</div>
<div class="">
    <div class="mx-4 mt-3 top-contents text-center">
        <h5>DEMO</h5>    
    </div>
    <div class="text-center">
        <div>
            <a href="" target="_blank" rel="noopener noreferrer">http://media_bookmark/mbm/demosample</a>
        </div>
        <div class="mt-2">
            <img src="{{ asset('storage/common').'/demoimg.png' }}" alt="">
        </div>
    </div>
    <div class="footer-wrap mt-3">
        <div class="d-flex justify-contents-between pt-2">
            <div class="w-50 text-center">
                <a href="/terms_of_use">
                Terms    
                </a>
            </div>
            <div class="w-50 text-center">
                <a href="/privacy_policy">Privacy</a>
            </div>
            <div class="w-50 text-center">
                <a href="/about_us">
                About Us
                </a>
            </div>
        </div>
        <div class="text-center py-1">
            <div>
                2020 Rise Inc.<br><br>
            </div>
        </div>
    </div>
</div>
@endsection       
