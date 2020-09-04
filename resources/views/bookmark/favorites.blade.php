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
    
    <div class="mx-2">
        <div class="bookmark-card my-3" v-for="bookmark in bookmarks" >
        @include('layouts.bookmark-card', ['my_bookmark' => false])
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
        }
    })
</script>
@endsection

