@extends('layouts.app')


@section('ogp-matadata')
<meta property="og:title" content="Media Bookmark">
<meta property="og:description" content="Media Bookmark">
<meta property="og:image" content="{{ asset('storage').'/common/toppage.gif' }}">
@endsection

@section('content')
<div>
    
    <div class="">
            <div class="my-2 text-center function-title">
            My Media Bookmarks
            </div>
            <div class="text-center mt-1 mr-2">
            <button type="" data-toggle="modal" data-target="#add-bookmark-modal" class="submit-button" @click="init_modal_data">
            <i class="fas fa-plus"></i> Add Media Bookmark</button>
            </div>
    </div>

    @php
        $shared_url = url('').'/mbm/'; 
    @endphp

    <div class="mx-2 d-flex justify-content-center">
        <div class="w-100">
            <div class="bookmark-card my-3" v-for="bookmark in bookmarks" >
            @include('layouts.bookmark-card', ['my_bookmark' => true])
            </div>
        </div>
    </div>
    
    <div><br> <br> <br> <br> </div>
    @include('layouts.contents-footer', ['current' => 'home'])
</div>
@endsection

@section('modal-contents')
<div class="modal fade" id="add-bookmark-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header p-0 d-flex justify-content-end">
            <div class="py-2">
                <button id="modal_close_btn" type="button" class="close py-2" data-dismiss="modal">&times;</button>
            </div>
        </div>
            <div class="mx-4">
                <div class="text-center my-2">
                    <h5>New Media Bookmark</h5>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" v-model="modal_title" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea v-model="modal_comment" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label class="modal-label" for="is_public">Search機能に対して公開する</label>
                    <div class="row mx-2 pt-1">
                        <!-- Rounded switch -->
                        <label class="switch">
                        <input type="checkbox" v-model="is_public" true-value="1" false-value="0">
                        <span class="slider round"></span>
                        </label>
                        <template v-if="is_public==1">
                            <div class="ml-2 modal-label"><i class="fas fa-unlock"> 公開(public)</i></div>
                        </template>
                        <template v-else>
                            <div class="ml-2 modal-label"><i class="fas fa-lock"> 非公開(private)</i></div>
                        </template>
                    </div>
                </div>
                <div class="row my-3 mx-2 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="OK" @click="submit_new_bookmark">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.sharemodal')

@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            bookmarks: [],
            modal_title: '',
            modal_comment: '',
            is_public: 1,
            share_title: '',
            share_comment: '',
            shared_url: '',
            qr_code_url: '',

        },
        methods: {
            init_modal_data: function() {
                this.modal_title = '';
                this.modal_comment = '';
                this.is_public = 1;
            },
            submit_new_bookmark: function() {
                axios
                .post('/bookmark/store', {
                    user_id: {{ Auth::user()->id }},
                    title: this.modal_title,
                    comment: this.modal_comment,
                    is_public: this.is_public,
                    type: 'create',
                })
                .then( response => {
                    // console.log(response.data);
                    this.bookmarks = response.data;
                    $("#modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            create_share_data: function(bookmark) {
                this.share_title = bookmark.title;
                share_title = this.share_title + '\n';
                this.share_comment = bookmark.comment;
                shared_url = '{{ $shared_url}}' + bookmark.share_token;
                this.shared_url = shared_url;
                this.qr_code_url = `https://api.qrserver.com/v1/create-qr-code/?data=${shared_url}&amp;size=200x200`;
            },
        },
        created: function() {
            axios
                .get('/bookmark/user/{{ $auth->id }}')
                .then( response => {
                    this.bookmarks = response.data;
                })    
                .catch(function(error) {
                    console.log(error);
                });
        },
        mounted: function() {
            $('#share-modal').on('shown.bs.modal', function (event) {
                tweet_area = document.getElementById('tweet-area');
                $('#tweet-area').empty(); //既存のボタン消す
                twttr.widgets.createShareButton(
                    shared_url,
                    document.getElementById("tweet-area"),
                    {
                    lang: 'ja',
                    text: share_title,
                    hashtags: "media_bookmark", 
                    }
                );
                line_url = 'http://line.me/R/msg/text/?' + share_title + '\n' + shared_url;
                $('#line-sharebutton').attr('href', line_url);

                $('.fb-share-button').attr('data-href', shared_url);
                console.log(shared_url);

                var js, fjs = document.getElementsByTagName('script')[0];
                if (document.getElementById('facebook-jssdk')) return;
                js = document.createElement('script'); js.id = 'facebook-jssdk';
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
                });
        },
    })
</script>
@endsection
