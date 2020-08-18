@extends('layouts.app')

@section('content')
<div>
    
    <div class="">
            <div class="my-2 text-center">
            <h5>My Media Bookmarks</h5>
            </div>
            <div class="text-right mt-1 mr-2">
                <img class="" src="{{ asset('storage').'/common/ic_add_circle.png' }}" width="20px" data-toggle="modal" data-target="#add-bookmark-modal" @click="init_modal_data">
            </div>
    </div>
    
    <div class="d-flex justify-content-between border-bottom mt-2 pb-2" v-for="(bookmark,index) in bookmarks">
        @php
            $shared_url = url('').'/mbm/'; 
        @endphp
        <div class="ml-2 align-top w-80">
            <div class="bookmark-title w-100">
                <a v-bind:href="'{{ $shared_url}}' + bookmark.share_token " target="_blank">
                @{{ bookmark.title }}
                </a>
            </div>
                <!-- <div class="bookmark-comment">
                    @{{ bookmark.comment }}
                </div> -->
        </div>
        <div class="mx-2 my-auto w-20">
            <a v-bind:href="'/bookmark/edit/'+bookmark.id">
                <img class="" src="{{ asset('storage').'/common/ic_arrow.png' }}">
            </a>
        </div>
    </div>
    <div><br> <br> <br> <br> </div>
    @include('layouts.contents-footer', ['current' => 'home'])
</div>
@endsection

@section('modal-contents')
<div class="modal fade" id="add-bookmark-modal">
    <div class="modal-dialog modal-sm">
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
                <div class="row my-3 mx-2 d-flex justify-content-center">
                    <input type="submit" class="btn btn-primary" value="OK" @click="submit_new_bookmark">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            bookmarks: [],
            modal_title: '',
            modal_comment: ''
        },
        methods: {
            init_modal_data: function() {
                this.modal_title = '';
                this.modal_comment = '';
            },
            submit_new_bookmark: function() {
                axios
                .post('/bookmark/store', {
                    user_id: {{ Auth::user()->id }},
                    title: this.modal_title,
                    comment: this.modal_comment,
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
            }
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
        }
    })
</script>
@endsection
