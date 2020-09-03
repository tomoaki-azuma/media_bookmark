@extends('layouts.app')


@section('ogp-matadata')
<meta property="og:title" content="Media Bookmark">
<meta property="og:description" content="Media Bookmark">
<meta property="og:image" content="{{ asset('storage').'/common/toppage.gif' }}">
@endsection


@section('bookmark-edit-header')
<div class="d-flex">
    <div class="mx-2 bookmark-card-icon">
        <a href="/home">
        <i class="fas fa-angle-left fa-2x"></i>
        </a>
    </div>
    <div class="ml-2 w-100">
        <div class="my-1">
            <div class="bookmark-edit-title">@{{ bookmark_title }}</div>
        </div>
        <div class="my-2">
            <div class="bookmark-edit-comment">@{{ bookmark_comment }}</div>
        </div>
        <div class="d-flex justify-content-end">
                    <div class="mx-2">
                        <a class="p-2" href="" data-toggle="modal" data-target="#share-modal" @click="create_modal_data()">
                        <i class="fas fa-share-alt"></i>
                        </a>
                    </div>
                    <div class="mx-2">
                        <a class="m-2" href="" data-toggle="modal" data-target="#edit-bookmark-modal" @click="create_modal_bookmark_data('update')" >
                        <i class="fas fa-pen"></i>
                        </a>
                    </div>
                    <div class="mx-2">
                        <a class="m-2" href="" data-toggle="modal" data-target="#edit-bookmark-modal" @click="create_modal_bookmark_data('delete')" >
                        <i class="fas fa-trash"></i>
                        </a>
                    </div>
        </div>
    </div>
</div>
@endsection

@section('content')

@php
    $shared_url = url('').'/mbm/'; 
@endphp
<div class="px-2">
    <div>
            <div>
                <div class="mx-2 border-bottom d-flex justify-content-center py-2">
                    <div class="">
                        <a class="text-white m-2" href="#" data-toggle="modal" data-target="#myModal" @click="init_program_modal">
                        <button type="" class="submit-button">
                        <i class="fas fa-plus"></i> Add Media Bookmark</button>
                        </a>
                    </div>
                </div>
                <div>
                    <div v-for="(program, index) in programs" class="edit-contents my-2 py-1 mx-1 px-0">
                        <div class="d-flex justify-content-between">
                            <div class="program-title">
                                <div class="url-title" >
                                    @{{ program.title }} 
                                </div>

                            </div>
                            <div class="mx-2 program-img">
                                <img v-bind:src="program.thumbnail_img" alt="" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                        <div class="url-comment my-3">
                            <div class="">
                                @{{ program.comment }}

                                <div class="url-link mt-2">
                                    <a v-bind:href="program.url" target="_blank">@{{ program.url}}</a> 
                                </div>
                            <div class="d-flex justify-content-end text-right text-white mt-2">
                                <div class="mx-3">
                                <a class="" href="#" data-toggle="modal" data-target="#myModal" @click="edit_program(program)" role="button">
                                <button type="" class="edit-button">
                                Edit</button>
                                </div>
                                </a>
                                <div>
                                <a class="" href="#" data-toggle="modal" data-target="#myModal" @click="delete_program(program)" role="button">
                                <button type="" class="delete-button">
                                Delete</button>
                                </a> 
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                
                    <div><br> <br></div>
                    </div>
                
                </div>
            </div>
        </div>
</div>
@endsection

@section('modal-contents')
<!-- modal area -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header p-2">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="tab-content mx-3">
                <div class="d-flex justify-content-center mt-2">
                    <div class="">
                        <template v-if="edit_type === 'create'">
                            <div class="function-title">Add new program</div>
                        </template>
                        <template v-if="edit_type === 'update'">
                            <div class="function-title">Edit program</div>
                        </template>
                        <template v-if="edit_type === 'delete'">
                            <div class="function-title">Delete program</div>
                        </template>
                    </div>
                </div>
                <div id="theme" class="tab-pane active">
                    <template v-if="edit_type != 'delete'">
                    <div class="form-group mb-1">
                        <div class="d-flex justify-content-between my-2">
                            <label for="new_program_url" class="mr-3">URL</label>
                        </div>
                        
                        <textarea v-model="new_program_url" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                       <button type="button" class="submit-button-middle" value="META" @click="get_metadata">Get metadata via URL</button>
                    </div>
                    <div class="form-group">
                        <label for="new_program_title" class="mr-3">Title</label>
                        <input type="text" v-model="new_program_title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="new_program_comment" class="mr-3">Comment</label>
                        <textarea v-model="new_program_comment" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="new_program_image" class="mr-3">Thumbnail(URL)</label>
                        <textarea v-model="new_program_image" class="form-control"></textarea>
                        <img v-bind:src="new_program_image" class="img-fluid" alt="">
                    </div>
                    </template>
                    <template v-else>
                    <div class="form-group mb-1">
                        <div class="d-flex justify-content-between my-2">
                            <label for="new_program_url" class="mr-3">URL</label>
                        </div>
                        
                        <textarea v-model="new_program_url" class="form-control" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="new_program_title" class="mr-3">Title</label>
                        <input type="text" v-model="new_program_title" class="form-control" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="new_program_comment" class="mr-3">Comment</label>
                        <textarea v-model="new_program_comment" class="form-control" disabled></textarea>
                    </div>
                    </template>
                    <div class="row my-3 mx-2 d-flex justify-content-around">
                        <template v-if="edit_type === 'delete'">
                            <button type="button" class="submit-button-half-delete" value="DELETE" @click="submit_delete_program" data-dismiss="modal">DELETE</button>
                        </template>
                        <template v-else>
                            <button type="button" class="submit-button-half" @click="submit_new_program" data-dismiss="modal">OK</button>
                        </template>
                        <button type="button" class="submit-button-half-cancel" @click="clear_values" data-dismiss="modal" >Cancel</button>
                    </div>
                </div>
                <template v-if="edit_type === 'create'">
                    <div id="helper" class="tab-pane">
                        Sorry, Under constructing ...
                    </div>
                    <div id="myprograms" class="tab-pane">
                        Sorry, Under constructing ...
                    </div>
                </template>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="share-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="mt-1 mr-1"> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="mx-4">
                <div class="text-center my-2">
                    <div class="function-title">Share Your Media Bookmark</div>
                </div>
                <div class="my-3">
                    <div><u>Title</u></div>
                    <div class="ml-2 bookmark-title">@{{ modal_title}}</div>
                </div>
                <div class="my-3">
                    <div><u>Comment</u></div>
                    <div class="ml-2">@{{ modal_comment}}</div>
                </div>
                <div class="my-3">
                    <div><u>Share via</u></div>
                    <div class="ml-2">
                    <input id="copy-target" class="form-control-plaintext" type="text" v-bind:value=shared_url readonly>
                    </div>
                    <div class="text-right"><img src="{{ asset('storage').'/common/ic_clipboard.png' }}" alt="" @click="copy_clipboard()"></div>
                </div>
                <div class="my-3">
                    <div class="ml-2">QR Code</div>
                    <div class="text-center my-2"><img v-bind:src="qr_code_url" width="150" height="150" alt="" title="" /></div>
                </div>
                <div class="my-3">
                    <div class="ml-2">SNS</div>
                    <div class="d-flex justify-content-around my-3">
                    <img src="{{ asset('storage').'/common/twitter-icon.png' }}" alt="">
                    <img src="{{ asset('storage').'/common/facebook-icon.png' }}" alt="">
                    <img src="{{ asset('storage').'/common/line-icon.png' }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-bookmark-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header p-0 d-flex justify-content-end">
            <div class="py-2">
                <button id="b_modal_close_btn" type="button" class="close py-2" data-dismiss="modal">&times;</button>
            </div>
        </div>
            <div class="mx-4">
                <div class="text-center my-2">
                    <h5>Edit Media Bookmark</h5>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <template v-if="bookmark_edit_type === 'update'">
                    <input type="text" v-model="bookmark_modal_title" class="form-control" value="">
                    </template>
                    <template v-else>
                    <input type="text" v-model="bookmark_modal_title" class="form-control" value="" disabled>
                    </template>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <template v-if="bookmark_edit_type === 'update'">
                    <textarea v-model="bookmark_modal_comment" class="form-control"></textarea>
                    </template>
                    <template v-else>
                    <textarea v-model="bookmark_modal_comment" class="form-control" disabled></textarea>
                    </template>
                </div>
                <div class="row my-3 mx-2 d-flex justify-content-around">
                    <template v-if="bookmark_edit_type === 'update'">
                        <button class="submit-button-half" @click="submit_edit_bookmark">
                        OK
                        </button>
                    </template>
                    <template v-else>
                    <button class="submit-button-half-delete" @click="submit_delete_bookmark">DELETE</button>
                    </template>
                    <button class="submit-button-half-cancel" data-dismiss="modal">
                    Cancel 
                    </button>
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
            bookmark_id: '{{ $bookmark->id }}',
            bookmark_title: '{{ $bookmark->title }}',
            bookmark_comment: '{{ $bookmark->comment }}',
            bookmark_modal_title: '',
            bookmark_modal_comment: '',
            bookmark_edit_type: 'update',
            programs: [],
            new_program_title: '',
            new_program_comment: '',
            new_program_url: '',
            new_program_image: '',
            edit_type: '',
            program_id: '',
            modal_title: '',
            modal_comment: '',
            qr_code_url: '',
            shared_url: '',
        },
        methods: {
            init_program_modal: function() {
                this.edit_type = 'create';
                this.clear_values();
            },
            submit_new_program: function() {
                axios
                .post('/program/store', {
                    id: this.program_id,
                    user_id: {{ Auth::user()->id }},
                    bookmark_id: {{ $bookmark->id }},
                    title: this.new_program_title,
                    comment: this.new_program_comment,
                    url: this.new_program_url,
                    type: this.edit_type,
                    image: this.new_program_image,
                })
                .then( response => {
                    // console.log(response.data);
                    this.programs = response.data;
                    this.clear_values();
                    $("#b_modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            edit_program: function(program) {
                this.edit_type = 'update';
                this.program_id = program.id;
                this.new_program_title = program.title;
                this.new_program_comment = program.comment;
                this.new_program_url = program.url;
                this.new_program_image = program.thumbnail_img;
            },
            delete_program: function(program) {
                this.edit_type = 'delete';
                this.program_id = program.id;
                this.new_program_title = program.title;
                this.new_program_comment = program.comment;
                this.new_program_url = program.url;
                this.new_program_image = program.thumbnail_img;
            },
            submit_delete_program: function() {
                axios
                .post('/program/destroy', {
                    id: this.program_id,
                    bookmark_id: {{ $bookmark->id }}
                })
                .then( response => {
                    this.programs = response.data;
                    this.clear_values();
                    $("#b_modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            clear_values() {
                this.new_program_title = '';
                this.new_program_comment = '';
                this.new_program_url = '';
                this.new_program_image = '';
            },
            get_metadata: function() {
                if (this.new_program_url == '') {
                    return;
                }
                axios
                .post('/program/metadata', {
                    url: this.new_program_url,
                })
                .then( response => {
                    this.new_program_comment = response.data.comment;
                    this.new_program_title = response.data.title;
                    this.new_program_image = response.data.image;
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            create_modal_data: function() {
                this.modal_title = '{{ $bookmark->title }}';
                this.modal_comment = '{{ $bookmark->comment }}';
                shared_url = '{{ $shared_url.$bookmark->share_token }}';
                this.shared_url = shared_url;
                this.qr_code_url = `https://api.qrserver.com/v1/create-qr-code/?data=${shared_url}&amp;size=200x200`;
            },
            copy_clipboard: function() {
                var copyTarget = document.getElementById("copy-target");
                copyTarget.select();
                document.execCommand("Copy");
            },
            create_modal_bookmark_data: function (edit_type){
                this.bookmark_edit_type = edit_type;
                this.bookmark_modal_title = this.bookmark_title;
                this.bookmark_modal_comment = this.bookmark_comment;
            },
            submit_edit_bookmark: function() {
                axios
                .post('/bookmark/store', {
                    id: this.bookmark_id,
                    title: this.bookmark_modal_title,
                    comment: this.bookmark_modal_comment,
                    type: 'update'
                })
                .then( response => {
                    this.bookmark_title = response.data.title;
                    this.bookmark_comment = response.data.comment;
                    $("#b_modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
            submit_delete_bookmark: function() {
                axios
                .post('/bookmark/destroy', {
                    id: this.bookmark_id,
                })
                .then( response => {
                    location.href='/home';
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
        },
        created: function() {
            axios
                .get('/program/bm/{{ $bookmark->id }}')
                .then( response => {
                    this.programs = response.data;
                })    
                .catch(function(error) {
                    console.log(error);
                });
        }
    })
</script>
@endsection
