@extends('layouts.app')

@php
    $shared_url = url('').'/mbm/'; 
@endphp

@section('content')
<div>
    <div class="mx-2">
        <div class="">
            <div class="my-2 text-center">
                <h5>My Favorites</h5>
            </div>
        </div>
    </div>
    <div class="mx-2">
        <div class="bookmark-card my-3" v-for="bookmark in bookmarks" >
            <div class="bookmark-card-body p-2 d-flex justify-content-between">
                <div class="">
                    <div class="bookmark-card-title">@{{ bookmark.title }}</div>
                    <div>
                    <a v-bind:href="'{{ $shared_url }}'+bookmark.share_token" class="bookmark-card-link" target="_blank">{{ $shared_url }}@{{ bookmark.share_token }}</a>
                    </div>
                    <div class="bookmark-card-text mt-2">@{{ bookmark.comment }}</div>
                    <div class="bookmark-card-footer d-flex my-2">
                    <div class="mr-2">
                    editor: @{{ bookmark.user.name }}
                    </div>
                    <div>
                    view: 230</div>
                    </div>
                </div>
                <div class="bookmark-card-icon mt-2">
                    <template v-if="include_favorite(bookmark.id)">
                        <img src="{{ asset('storage').'/common/ic_favorite.png' }}" @click="delete_favorite(bookmark.id)">
                    </template>
                    <template v-else>
                        <img src="{{ asset('storage').'/common/ic_heart.png' }}" alt="" @click="add_favorite(bookmark.id)">
                    </template>
                </div>
            </div>
        </div>
    </div>

    <div><br> <br> <br> <br> </div>
    </div>
                
    @include('layouts.contents-footer', ['current' => 'favorite'])
</div>
@endsection

@section('modal-contents')

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
            user_id: ''
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

