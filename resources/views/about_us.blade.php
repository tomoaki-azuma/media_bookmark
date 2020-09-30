@extends('layouts.app')


@section('content')
    <div class="mx-2">
        <div class="my-2 text-center function-title">
        About Us
        </div>
        <div class="px-2 privacy-policy">
        <div class="mt-4 subtitle pl-2">開発者</div>
        <div class="mt-2 text-center">
        <img src="https://pbs.twimg.com/profile_images/1268055630331342848/qLHo-vC9_400x400.jpg" alt="" class="rounded-circle" width="100px">
        </div>
        <div class="text-center mt-1 my-link">
        <i class="fab fa-twitter fa-lg"></i> <a href="https://twitter.com/TomoakiAzuma" target="_blank">tomoro</a>
        </div> 
        <div class="mt-2">
        株式会社ライズ代表、弁理士。特許調査業務をメインに知財業務のアドバイス、データ処理・分析を業務としています。<br>
        趣味はプログラミング、コーヒー、ゴルフ、サウナ、麻婆豆腐と担々麺、コテンラジオ(リスナーコミュニティ活動)。<br>
        </div>
        <div class="mt-4 subtitle pl-2">本サービスについて</div>
        <div class="mt-2">
        本サービスはプログラミング学校 <a href="https://gsacademy.jp/" target="_blank">G's Academy</a>の卒業制作をきっかけとして、開発しました。<br>
        コロナ禍でテレワークや家籠りが多くなる中、仕事・プライベートいずれにおいても情報やコンテンツのシェア、またその閲覧方法が重要となっていると感じています。<br>
        その一助になればと思いサービスを作成しました。
        </div>
        <div class="mt-4 subtitle pl-2">株式会社ライズについて</div>
        <div class="mt-2">
        本サービスは個人開発サービスですが、利用者の安心のため利用規約・個人情報保護は株式会社ライズの元で宣言し、責任を負うこととします。<br>
        会社情報は弊社HPにてご覧いただけます。
        </div>
        <div class="mt-3">
            <a href="http://www.rise-pat.com" target="_blank">
            <img class="img-fluid" src="{{ asset('storage').'/common/rise-logo.gif' }}" alt="" width="100px">
            </a><br><br>
            <a href="http://www.rise-pat.com" target="_blank">
            http://www.rise-pat.com
            </a>
        </div>
        <div class="mt-4 subtitle pl-2">Free to Use</div>
        <div class="mt-2">
        本サービスは無料にて登録、使用いただけます。主な理由としては以下の通りです。
        <ul class="mt-1">
            <li>弊社広報活動の一環であること</li>
            <li>自身の技術アピールのポートフォリオの位置づけ</li>
            <li>運用も含めてプログラミングの学習の一環であること</li>
        </ul>
        そのため、弊社を含めいかなる者からもこのサービスに対する課金や請求は発生しません。<br>
        ただし、このサービスによってユーザが受けるいかなる損害も免責されること、予告なく機能を変更（主には改善を目的とします）すること等ご了承ください。<br>
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