
@extends('layouts.app')

@section('content')
    <div class="mx-2">
        <div class="my-2 text-center function-title">
        Help 
        </div>
        <div class="px-2 privacy-policy">
        <div class="mt-4 subtitle pl-2">ユーザー登録</div>
        <div class="mt-4 text-center">
            <img src="{{ asset('storage/help').'/welcome.png' }}" alt="" width="150px" class="border">
        </div>
        <div class="mt-2">
        ユーザ登録は「新規会員登録する」を選択してメールアドレス＋パスワードにての登録あるいは、
        SNS認証経由にて行えます。ユーザの識別はメールアドレスにて行います。<br>
        メールアドレスが同じであればどのログイン方法でログインしても同じユーザと認識されます。<be>
        逆に、SNSの登録メールアドレスが異なる場合は、それぞれ別ユーザとして認識されます。<br><br>
        メールアドレス＋パスワードにて登録の場合、メールアドレス宛に認証メールが送信されます。
        </div>
        <div class="mt-4 subtitle pl-2">Media Bookmark作成</div>
        <div class="mt-4 text-center">
            <img src="{{ asset('storage/help').'/home.png' }}" alt="" width="150px" class="border">
        </div>
        <div class="mt-2">
        ログイン後ホーム画面が表示されます。ここに自身のMedia Bookmarkが一覧表示されます。<br>
        初期状態では何もありませんので追加ボタンで新規作成してください。新規作成後、カード上のオブジェクトが表示されます。
        これがMedia Bookmarkの一つの単位になります。<br>作成後、Media Bookmarkのタイトルをクリックするとコンテンツ本体が表示されます。
        </div>
        <div class="mt-4 subtitle pl-2">Media Bookmark編集＆URL登録</div>
        <div class="mt-4 text-center">
            <img src="{{ asset('storage/help').'/edit.png' }}" alt="" width="150px" class="border">
        </div>
        <div class="mt-2">
        ホーム画面の各Media Bookmarkの「＞」ボタンをクリックすると編集画面が表示されます。<br>
        タイトル下の白色のアイコンはMedia Bookmarkのタイトル、コメントの編集と削除の機能です。<br>
        「URLを追加」ボタンでコンテンツを追加することができます。コンテンツの情報はURLを入力して「URLからデータを取得」
        ボタンで自動で取得します。各項目は自由に編集することができます。 
        </div>
        <div class="mt-4 subtitle pl-2">検索(Search)</div>
        <div class="mt-4 text-center">
            <img src="{{ asset('storage/help').'/search.png' }}" alt="" width="150px" class="border">
        </div>
        <div class="mt-2">
        他ユーザのMedia Bookmarkをキーワードにて検索することができます。キーワードはタイトル、コメント、ユーザ名、トークンが検索対象です。<br>
        トークンとはシェアされるMedia BookmarkのURLの最後の13桁のランダム文字列です。一部分でも部分一致で検索可能です<br>
        各Media Bookmarkにはハートマークがあり、クリックすることで自身のお気に入りに追加することができます。<br>
        お気に入りは保存され、「Favorite」画面に表示されます。
        </div>
        <br><br><br>
    </div>
@endsection