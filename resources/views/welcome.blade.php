@extends('layouts.app')

@section('ogp-matadata')
<meta property="og:title" content="Media Bookmark">
<meta property="og:description" content="Media Bookmark">
<meta property="og:image" content="{{ asset('storage').'/common/toppage.gif' }}">
@endsection

@section('content')
<div>
    <img class="img-fluid" src="{{ asset('storage').'/common/toppage.gif' }}" alt="">
</div>
<div class="d-flex justify-content-end my-1">
    <div class="mx-1">
        @auth
            <a href="{{ url('/home') }}">Home</a>
        @else
            <a class="mx-1" href="{{ route('login') }}">Login</a>
            <a class="mx-1" href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</div>
<div class="mx-4 mt-3 top-contents">
        Media Bookmarkは自分の好きなコンテンツのブックマークを作成し、世界中の人と共有できるサービスです。
</div>
<div class="mx-4 mt-3 top-contents">
        あなたの好きなHP、ブログ、動画、画像あらゆるメディアへのリンクをメディアブックマークに登録して共有しましょう。
</div>
<div class="mx-4 mt-3 top-contents text-center">
    <h5>Features</h5>    
</div>
<div class="mx-4 mt-3 top-contents">
    <div>簡単登録</div>
    <div>
        ブックマークへのリンクの登録はURLをコピーするだけ。タイトルや詳細情報、サムネイルは自動で取得します。
    </div>
</div>
<div class="mx-4 mt-3 top-contents">
    <div>Free to use</div>
    <div>
    ユーザー登録をしていただければ無料にて利用できます。
    ユーザ登録はメールアドレスまたはSNSアカウントにてできます。
    </div>
</div>
<div class="mx-4 mt-3 top-contents">
    <div>多様なシェア方法</div>
    <div>
    ブックマークの共有は各種SNS、QRコード、URLリンクのコピーにより簡単に行えます。<br>ブックマークの共有者先は本サービスのユーザである必要はなく、多くの人に共有してもらうことができます。
    </div>
</div>
<div class="mx-4 mt-3 top-contents text-center">
    <h5>Demo</h5>    
</div>
<div class="mx-4 mt-3 top-contents">
百聞は一見に如かず。実際にデモを見てもらったほうがよいかもしれません。以下のQRコードまたはリンクからMedia Bookmarkとデモ動画をご覧ください。
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
        Terms    
    </div>
    <div class="w-50 text-center">
        Privacy
    </div>
</div>
<div class="d-flex justify-contents-between py-1">
    <div class="w-50 text-center">
        About Us
    </div>
    <div class="w-50 text-center">

    </div>
</div>
<div class="text-center py-1">
    <div>
        2020 Rise Inc.
    </div>
</div>
@endsection       
