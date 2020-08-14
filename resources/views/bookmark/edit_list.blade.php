@extends('layouts.app')

@section('content')
<div>
    
    <div class="d-flex">
            <div class="my-2 ml-2 mr-auto"></div>
            <div class="mt-1 mr-2">
                <img class="" src="{{ asset('storage').'/common/ic_add_circle.png' }}" data-toggle="modal" data-target="#create-modal" alt="">
            </div>
    </div>
    
    <div class="d-flex justify-content-between border-bottom mt-2 pb-2" v-for="bookmark in bookmarks">
        @php
            $shared_url = url('').'/mbm/'; 
        @endphp
        <div class="ml-2 align-top w-80">
            <a v-bind:href="'{{ $shared_url }}' + bookmark.share_token" target="_blank"></a>
            <div class="bookmark-title">
                @{{ bookmark.title }}
            </div>
            <div class="bookmark-comment">
                @{{ bookmark.comment }}
            </div>           
        </div>
        <div class="mx-2 my-auto w-20">
            <a v-bind:href="'/bookmark/edit/'+bookmark.id">
                <img class="" src="{{ asset('storage').'/common/ic_edit.png' }}" width="20px" >
            </a>
        </div>
    </div>
    @include('layouts.contents-footer', ['current' => 'edit'])
</div>
@endsection

@section('modal-contents')
<div class="modal fade" id="create-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="mx-4">
                <div class="text-center my-2">
                    <h5>Create Media Bookmark</h5>
                </div>
                
                <div class="my-3 form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" v-model="modal_title">
                </div>
                <div class="my-3 form-group">
                    <label for="comment">Description</label>
                    <textarea name="comment" class="form-control" v-model="modal_comment"></textarea>
                </div>
                <div class="row my-3 mx-2 d-flex justify-content-around">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="submit_new_bookmark">OK</button>
                    <button type="button" id="modal_close_btn" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
            modal_comment: '',
        },
        methods: {
            date_format: function(date) {
                d = new Date(date);
                console.log(d);
                return d.getFullYear() + '/' + (d.getMonth()+1) + '/' + d.getDate();
            },
            clear_value: function() {
                this.modal_title = '';
                this.modal_comment = '';
            },
            submit_new_bookmark: function() {
                console.log(this.modal_title);
                axios
                .post('/bookmark/store', {
                    user_id: {{ Auth::user()->id }},
                    type: 'create',
                    title: this.modal_title,
                    comment: this.modal_comment,
                })
                .then( response => {
                    this.bookmarks = response.data;
                    this.clear_values();
                    $("#modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
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
