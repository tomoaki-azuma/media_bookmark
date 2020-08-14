@extends('layouts.app')

@section('content')
<div class="px-2">
    <div>
        <div class="d-flex justify-content-between my-2">
            <div class="ml-2">
                <a href="/edit">
                    <img class="" src="{{ asset('storage').'/common/ic_back.png' }}" alt="">
                </a>
            </div>
            <div class="row mr-1">
                <div class="mx-2">
                    <img class="" src="{{ asset('storage').'/common/ic_edit.png' }}" alt="">
                </div>
                <div class="mx-2">
                    <img class="" src="{{ asset('storage').'/common/ic_trush.png' }}" alt="">
                </div>
            </div>
        </div> 
        <div class="mx-2">   
            <div class="my-2">
                <div><u>Title</u></div>
                <div class="ml-2 bookmark-title">{{ $bookmark->title }}</div>
            </div>
            <div class="my-2">
                <div><u>Comment</u></div>
                <div class="ml-2">{{ $bookmark->comment }}</div>
            </div>
        </div>
            <hr>
            <div>
                <div class="text-center">
                    <h5 class="m-0">Links</h5>
                </div>
                <div>
                    <div class="mx-2 d-flex justify-content-end">
                        <div class="thumbnail-box">
                            <a href="" data-toggle="modal" data-target="#myModal" @click="init_program_modal">
                                <img src="{{ asset('storage').'/common/ic_add_circle.png' }}">
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
                                <div class="">
                                <a class="" data-toggle="collapse" v-bind:href="'#collapseExample'+index" aria-expanded="false" v-bind:aria-controls="'collapseExample'+index">
                                <img src="{{ asset('storage').'/common/ic_more.png' }}">
                                </a>
                                <div class="collapse url-comment" v-bind:id="'collapseExample'+index">
                                    <div class="card card-body">
                                    @{{ program.comment }}
                                    <div class="url-link mt-2">
                                    <a v-bind:href="program.url" target="_blank">@{{ program.url}}</a> 
                                    </div>
                                    </div>
                                </div>                          
                                </div>
                            </div>
                            <div class="w-25 mx-2">
                                <img v-bind:src="program.thumbnail_img" alt="" class="img-fluid">
                            </div>
                        </div>
                            <!-- <div class="row">
                                <div class="text-left px-2"><span class="badge badge-secondary">Title</span></div>
                                <div class="text-left px-2" v-cloak>@{{ program.title }} </div>
                            </div> 
                            <div>
                                <img v-bind:src="program.thumbnail_img" alt="" class="img-fluid" width="100px">
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="text-left px-2"><span class="badge badge-secondary">Comment</span></div>
                            <div class="text-left px-2" v-cloak>@{{ program.comment }} </div>
                        </div>
                        <div class="row my-1">
                            <div class="text-left px-2"><span class="badge badge-secondary">URL</span></div>
                            <div class="text-left px-2" v-cloak>
                                <div><a v-bind:href="program.url" target="_blank">@{{ program.url }}</a></div>
                            </div>
                        </div>
                        
                        <div class="row d-flex justify-content-end align-self-end">
                             <div class="mx-2">
                                <a href="" data-toggle="modal" data-target="#myModal" @click="edit_program(program)">
                                    <i class="fas fa-edit fa-x"></i>
                                </a>
                            </div>
                            <div class="mx-2">
                                <a href="" data-toggle="modal" data-target="#myModal" @click="delete_program(program)">
                                    <i class="fas fa-trash-alt fa-x"></i>
                                </a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.contents-footer', ['current' => 'edit'])
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
@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            programs: [],
            new_program_title: '',
            new_program_comment: '',
            new_program_url: '',
            new_program_image: '',
            edit_type: '',
            program_id: ''
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
