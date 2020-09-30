@extends('layouts.app')

@php
    $shared_url = url('').'/mbm/'; 
@endphp

@section('content')
<div>
    <div class="mx-2">
        <div class="">
            <div class="my-2 text-center function-title">
                My Favorites
            </div>
        </div>
    </div>
    
    <div class="mx-2 d-flex justify-content-center">
        <div class="w-100">
            <div class="bookmark-card my-3" v-for="bookmark in bookmarks" >
            @include('layouts.bookmark-card', ['my_bookmark' => false])
            </div>
        </div>
    </div>

    <div><br> <br> <br> <br> </div>
    </div>
                
    @include('layouts.contents-footer', ['current' => 'favorite'])
</div>
@endsection

@section('modal-contents')
    @include('layouts.sharemodal')
@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            keyword: '',
            user: '',
            url: '',
            bookmarks: [],
            favorites: [],
            search_state: true,
            user_id: '',
            share_title: '',
            share_comment: '',
            shared_url: '',
            qr_code_url: ''
        },
        methods: {
            submit_search: function() {
                this.search_state = false;
                axios
                .post('/bookmark/search', {
                    keyword: this.keyword,
                    url: this.url,
                    user: this.user,
                })
                .then( response => {
                    this.bookmarks = response.data.bookmarks;
                    this.favorites = response.data.favorites;    
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            add_favorite: function(bookmark_id) {
                axios
                .post('/bookmark/add_favorite', {
                    bookmark_id: bookmark_id,
                })
                .then( response => {
                    this.favorites = response.data.favorites;          
                    this.bookmarks = response.data.favorite_bookmarks;
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            delete_favorite: function(bookmark_id) {
                axios
                .post('/bookmark/delete_favorite', {
                    bookmark_id: bookmark_id,
                })
                .then( response => {
                    this.favorites = response.data.favorites;
                    this.bookmarks = response.data.favorite_bookmarks;
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            include_favorite: function(bookmark_id) {
                return this.favorites.includes(bookmark_id);
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
            .get('/bookmark/get_my_favorite', {
            })
            .then( response => {
                this.bookmarks = response.data.bookmarks;
                this.favorites = response.data.favorites;    
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
                    text: this.share_title,
                    hashtags: "media_bookmark", 
                    }
                );
                line_url = 'http://line.me/R/msg/text/?' + share_title + '\n' + shared_url;
                $('#line-sharebutton').attr('href', line_url);

                $('.fb-share-button').attr('data-href', this.shared_url);

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

