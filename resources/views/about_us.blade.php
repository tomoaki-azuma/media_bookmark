@extends('layouts.app')


@section('content')
    <div class="mx-2">
        <div class="my-2 text-center function-title">
        About Us
        </div>
        <div class="px-2 privacy-policy">
        <div class="mt-4">
        本サービスMedia Bookmarkは株式会社ライズによって運営されています。
        </div>
        <div class="mt-4 subtitle pl-2">株式会社ライズについて</div>
        <div class="mt-2">
        株式会社ライズは特許に関する業務を行う会社です。<br>特許調査、特許業務コンサルティング（主に知財部を持たない企業の相談対応）、データ処理・分析
        を主な業務としています。会社情報は弊社HPにてご覧いただけます。
        </div>
        <div class="mt-3">
            <a href="http://www.rise-pat.com" target="_blank">
            <img class="img-fluid" src="{{ asset('storage').'/common/rise-logo.gif' }}" alt="" width="100px">
            </a><br><br>
            <a href="http://www.rise-pat.com" target="_blank">
            http://www.rise-pat.com
            </a>
        </div>
        <div class="mt-4 subtitle pl-2">本サービスについて</div>
        <div class="mt-2">
        本サービスは株式会社ライズ代表であり弁理士である東（あずま）がプログラミング学校 <a href="https://gsacademy.jp/" target="_blank">G's Academy</a>の卒業制作をきっかけとして、開発しました。<br><br>コロナ禍でテレワークや家籠りが多くなる中、仕事・プライベートいずれにおいても情報やコンテンツのシェア、またその閲覧方法が重要となっていると感じています。<br>
        その一助になればと思いサービスを作成しました。
        </div>
        <div class="mt-4 subtitle pl-2">Free to Use</div>
        <div class="mt-2">
        本サービスは無料にて登録、使用いただけます。主な理由としては以下の通りです。
        <ul class="mt-1">
            <li>弊社広報活動の一環であること</li>
            <li>弊社技術アピールのポートフォリオの位置づけであるため</li>
            <li>運用も含めてプログラミングの学習の一環であること</li>
        </ul>
        そのため、弊社を含めいかなる者からもこのサービスに対する課金や請求は発生しません。<br>
        ただし、このサービスによってユーザが受けるいかなる損害も弊社は免責されること、予告なく機能が変更（主には改善を目的とします）されること等ご了承ください。<br>
        くわしくは利用規約、プライバシーポリシーをご参照ください。
        </div>
        <div class="mt-4 subtitle pl-2">Contact Us</div>
        <div class="mt-2">
        本サービスについてのフィードバック、ご意見などご連絡ありましたら以下までお願いします。<br>
        mail: mbm@media-bookmark.app<br>
        twitter: <i class="fab fa-twitter"></i><a href="https://twitter.com/media_bookmark" target="_blank"> Media_Bookmark</a>
        </div>
        <br><br><br>
    </div>
@endsection