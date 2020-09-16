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
        <div>
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
            share_title: '',
            share_comment: '',
            shared_url: '',
            qr_code_url: ''
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
