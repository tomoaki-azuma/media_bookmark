@extends('layouts.app')

@section('content')

@php
    $shared_url = url('').'/mbm/'; 
@endphp
<div class="px-2">
    <div>
        <div class="d-flex justify-content-between my-2">
            <div class="text-center mb-1">
                <a href="/home">
                    <img class="" src="{{ asset('storage').'/common/ic_back.png' }}" width="20px" alt="">
                </a> 
            </div>
            <div class="row mr-1">
                <div class="mx-2">
                    <a href="" data-toggle="modal" data-target="#share-modal" @click="create_modal_data()">
                    <img class="" src="{{ asset('storage').'/common/ic_share.png'}}" width="20px" alt="">
                    </a>
                </div>
                <div class="mx-2">
                    <a href="" data-toggle="modal" data-target="#edit-bookmark-modal" @click="create_modal_bookmark_data('update')" >
                    <img class="" src="{{ asset('storage').'/common/ic_edit.png' }}" alt="">
                    </a>
                </div>
                <div class="mx-2">
                    <a href="" data-toggle="modal" data-target="#edit-bookmark-modal" @click="create_modal_bookmark_data('delete')" >
                    <img class="" src="{{ asset('storage').'/common/ic_trush.png' }}" alt="">
                    </a>
                </div>
            </div>
        </div> 
        <div class="mx-2">
            <div class="card mb-3">
                <div class="card-header p-0 m-0">
                <div class="my-1 text-center">
                    <div class="bookmark-edit-title">@{{ bookmark_title }}</div>
                </div>
                </div>   
                <div class="my-2">
                    <div class="ml-2 bookmark-edit-comment">@{{ bookmark_comment }}</div>
                </div>
            </div>    

        </div>
            <div>
                <div class="text-center url-header my-2">
                    <h5 class="py-1">Links</h5>
                </div>
                <div>
                    <div class="mx-2 d-flex justify-content-end">
                        <div class="thumbnail-box">
                            <a href="" data-toggle="modal" data-target="#myModal" @click="init_program_modal">
                                <img src="{{ asset('storage').'/common/ic_add_circle.png' }}" width="20px">
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div v-for="(program, index) in programs" class="border border-left-0 border-right-0 border-top-0 my-1 py-1 mx-1 px-0">
                        <div class="d-flex justify-content-between">
                            <div class="w-75">
                                <div class="url-title">
                                    @{{ program.title }} 
                                </div>
                                <div class="url-link">
                                    <a v-bind:href="program.url" target="_blank">@{{ program.url}}</a> 
                                </div>
                                <div class="">
                                <a class="" data-toggle="collapse" v-bind:href="'#collapseExample'+index" aria-expanded="false" v-bind:aria-controls="'collapseExample'+index">
                                <img src="{{ asset('storage').'/common/ic_more.png' }}">
                                </a>
                                <div class="collapse url-comment" v-bind:id="'collapseExample'+index">
                                    <div class="card card-body">
                                    @{{ program.comment }}
                                    <div class="url-link mt-2">
                                    </div>
                                    </div>
                                </div>                          
                                </div>
                            </div>
                            <div class="w-25 mx-2">
                                <img v-bind:src="program.thumbnail_img" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div><br> <br> <br> <br> </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.contents-footer', ['current' => 'home'])
</div>
@endsection

@section('modal-contents')
<!-- modal area -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <template v-if="edit_type === 'create'">
                    <h5 class="modal-title">Add new program</h5>
                </template>
                <template v-if="edit_type === 'update'">
                    <h5 class="modal-title">Edit program</h5>
                </template>
                <template v-if="edit_type === 'delete'">
                    <h5 class="modal-title">Delete program</h5>
                </template>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="tab-content mx-3">
                <div id="theme" class="tab-pane active">
                    <div class="form-group">
                        <div class="d-flex justify-content-between my-2">
                            <label for="new_program_url" class="mr-3">URL</label>
                            <button type="button" class="btn-sm btn-danger" value="META" @click="get_metadata">get metadata</button>
                        </div>
                        
                        <textarea v-model="new_program_url" class="form-control"></textarea>
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
                        <label for="new_program_image" class="mr-3">Thumbnail</label>
                        <textarea v-model="new_program_image" class="form-control"></textarea>
                        <img v-bind:src="new_program_image" class="img-fluid" alt="">
                    </div>
                    <div class="row my-3 mx-2 d-flex justify-content-center">
                        <template v-if="edit_type === 'delete'">
                            <button type="button" class="btn btn-danger" value="DELETE" @click="submit_delete_program">DELETE</button>
                        </template>
                        <template v-else>
                            <input type="submit" class="btn btn-primary" value="OK" @click="submit_new_program">
                        </template>
                        <div class="mx-3"><a href="/home" id="modal_close_btn" class="btn btn-secondary" role="button" data-dismiss="modal" @click="clear_values()">Cancel</a></div>
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
                    <h5>Share Your Media Bookmark</h5>
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
                <div class="row my-3 mx-2 d-flex justify-content-center">
                    <template v-if="bookmark_edit_type === 'update'">
                    <input type="submit" class="btn btn-primary" value="OK" @click="submit_edit_bookmark">
                    </template>
                    <template v-else>
                    <input type="submit" class="btn btn-danger" value="DELETE" @click="submit_delete_bookmark">
                    </template>
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
                    $("#modal_close_btn").click();
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
                this.new_program_image = program.image;
            },
            delete_program: function(program) {
                this.edit_type = 'delete';
                this.program_id = program.id;
                this.new_program_title = program.title;
                this.new_program_comment = program.comment;
                this.new_program_url = program.url;
                this.new_program_image = program.image;
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
                    $("#modal_close_btn").click();
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
