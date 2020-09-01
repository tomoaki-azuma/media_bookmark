@extends('layouts.app')

@php
    $shared_url = url('').'/mbm/'; 
@endphp

@section('content')
<div>
    <div class="mx-2">
        <div class="">
            <div class="my-2 text-center">
                <h5>Search</h5>
            </div>
        </div>
        <template v-if="search_state === true">
        <div class="my-4">
        Keyword (title, comment): 
            <div>
                <input type="text" v-model="keyword" class="form-control">
            </div>
        </div>
        <div class="my-4">
        User: 
            <div>
                <input type="text" v-model="user" class="form-control">
            </div>
        </div>
        <div class="my-4">
        Share URL Token:
        <div>ex.) 5f217cb6433b1</div> 
            <div>
                <input type="text" v-model="url" class="form-control">
            </div>
        </div>
        <div class="text-center">
            <input type="button" class="btn btn-primary" value="OK" @click="submit_search">
        </div>
        </template>
        <template v-else>
            <div class="text-right">
            <img src="{{ asset('storage').'/common/ic_search.png' }}" alt="" @click="change_search_state">
            </div>
            <template v-if="keyword !== ''">
            <div class="my-2">
            Keyword:@{{ keyword }} 
            </div>
            </template>
            <template v-if="user !== ''">
            <div class="my-2">
            User:@{{ user }} 
            </div>
            </template>
            <template v-if="url !== ''">
            <div class="my-2">
            URL:@{{ url }}
            </div>
            </template>
        </template>
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
                
    @include('layouts.contents-footer', ['current' => 'search'])
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
            change_search_state: function() {
                this.search_state = true;
            },
            add_favorite: function(bookmark_id) {
                axios
                .post('/bookmark/add_favorite', {
                    bookmark_id: bookmark_id,
                })
                .then( response => {
                    this.favorites = response.data.favorites;          
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
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            include_favorite: function(bookmark_id) {
                return this.favorites.includes(bookmark_id);
            },
        },
    })
</script>
@endsection

