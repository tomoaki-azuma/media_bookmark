@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <div>
                <h4>Edit Media Bookmark data</h4>
                <div class="card mb-5">
                    <form method="POST" action="/bookmark/store">
                        @csrf
                        <div class="form-group mx-3 my-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $bookmark->title }}">
                        </div>
                        <div class="form-group mx-3">
                            <label for="comment">Comment</label>
                            <textarea name="comment" class="form-control">{{ $bookmark->comment }}</textarea>
                        </div>
                        <div class="row my-3 mx-2 d-flex justify-content-center">
                            <input type="submit" class="btn btn-primary" value="Update">
                            <div class="mx-3"><a href="/home" class="btn btn-secondary" role="button">Cancel</a></div>
                            <input type="hidden" name="id" value="{{ $bookmark->id }}">
                            <input type="hidden" name="type" value="update">
                        </div>
                    </form>
                </div>
            </div>
            
            <div>
                <div class="d-flex">
                    <h4>Add Your Favorites</h4><a href="/home" class="btn btn-secondary btn-sm mx-3" role="button">Back</a>
                </div>
                <div>
                    <div class="d-flex mx-0 mt-3">
                        <a href="" data-toggle="modal" data-target="#myModal" @click="init_program_modal">
                            <button type="button" class="btn btn-primary btn-sm">Add Program</button>
                        </a>
                    </div>
                    <div v-for="program in programs" class="border border-left-0 border-right-0 border-top-0 my-1 py-1 mx-1 px-0">
                        <div class="row my-1">
                            <div class="text-left px-2"><span class="badge badge-secondary">Title</span></div>
                            <div class="text-left px-2" v-cloak>@{{ program.title }} </div>
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
                        </div>
                    </div>
                </div>
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
                                        <label for="new_program_url" class="mr-3">URL</label>
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
                                    <div class="row my-3 mx-2 d-flex justify-content-center">
                                        <template v-if="edit_type === 'delete'">
                                            <button type="button" class="btn btn-danger" value="DELETE" @click="submit_delete_program">DELETE</button>
                                        </template>
                                        <template v-else>
                                            <input type="submit" class="btn btn-primary" value="OK" @click="submit_new_program">
                                        </template>
                                        <div class="mx-3"><a href="/home" id="modal_close_btn" class="btn btn-secondary" role="button" data-dismiss="modal">Cancel</a></div>
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
            edit_type: '',
            program_id: ''
        },
        methods: {
            init_program_modal: function() {
                this.edit_type = 'create';
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
                    type: this.edit_type
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
            },
            delete_program: function(program) {
                this.edit_type = 'delete';
                this.program_id = program.id;
                this.new_program_title = program.title;
                this.new_program_comment = program.comment;
                this.new_program_url = program.url;
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
            }
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
