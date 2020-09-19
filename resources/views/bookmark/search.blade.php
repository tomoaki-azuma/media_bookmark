@extends('layouts.app')

@php
    $shared_url = url('').'/mbm/'; 
@endphp

@section('content')
<div>
    <div class="mx-2">
        <div class="">
            <div class="my-2 text-center function-title">
                Search
            </div>
        </div>
        <div class="text-center search-guide">
            タイトル、コメント、ユーザー名、URLのトークンなどで検索
        </div>
        <div class="my-4">
            <div class="input-group d-flex justify-content-center">
                <input type="text" class="form-control search-form" v-model="keyword">
                <span class="input-group-btn">
                    <button type="button" class="btn submit-button-mini ml-2" @click="submit_search">
                    <i class="fas fa-search"></i>
                    </button>
                </span>
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
                
    @include('layouts.contents-footer', ['current' => 'search'])
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
                })
                .then( response => {
                    this.bookmarks = response.data.bookmarks;
                    this.favorites = response.data.favorites;    
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            change_search_state: function() {
                this.search_state = true;
            },
            add_favorite: function(bookmark_id) {
                axios
                .post('/bookmark/add_favorite_and_search', {
                    keyword: this.keyword,
                    bookmark_id: bookmark_id,
                })
                .then( response => {
                    this.bookmarks = response.data.bookmarks;
                    this.favorites = response.data.favorites;          
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            delete_favorite: function(bookmark_id) {
                axios
                .post('/bookmark/delete_favorite_and_search', {
                    bookmark_id: bookmark_id,
                    keyword: this.keyword,
                })
                .then( response => {
                    this.favorites = response.data.favorites;
                    this.bookmarks = response.data.bookmarks;      
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
    })
</script>
@endsection

