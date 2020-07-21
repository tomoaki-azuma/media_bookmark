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
                        <div class="row">
                            <div class="text-left px-2"><span class="badge badge-secondary">Title</span></div>
                            <div class="text-left px-2" v-cloak>@{{ program.title }} </div>
                        </div>
                        <div class="row">
                            <div class="text-left px-2"><span class="badge badge-secondary">Comment</span></div>
                            <div class="text-left px-2" v-cloak>@{{ program.comment }} </div>
                        </div>
                        <div class="row">
                            <div class="text-left px-2"><span class="badge badge-secondary">URL</span></div>
                            <div class="text-left px-2" v-cloak>
                                <div v-for="url_element in program.urls" class="row">
                                    <div>
                                    <template v-if="url_element.file_type == 'y'">
                                        <i class="fab fa-youtube mx-2"></i>
                                    </template>
                                    <template v-if="url_element.file_type == 'p'">
                                        <i class="fas fa-podcast mx-2"></i>
                                    </template>
                                    <template v-if="url_element.file_type == 'i'">
                                        <i class="fas fa-images mx-2"></i>
                                    </template>
                                    <template v-if="url_element.file_type == 'w'">
                                        <i class="far fa-file-alt mx-2"></i>
                                    </template>
                                    <template v-if="url_element.file_type == 's'">
                                        <i class="fab fa-dropbox mx-2"></i></i>
                                    </template>
                                    </div>
                                    <div><a v-bind:href="url_element['url']" target="_blank">@{{ url_element['url'] }}</a></div>
                                </div>
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
                                        <label for="new_program_title" class="mr-3">Title.</label>
                                        <input type="text" v-model="new_program_title" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_program_comment" class="mr-3">Comment</label>
                                        <textarea v-model="new_program_comment" class="form-control"></textarea>
                                    </div>
                                    <div class="border-bottom border-danger">Contents URL (up to 3)</div>
                                    <div v-for="(new_url, index) in new_program_urls" class="border-bottom border-secondary">
                                        <label for="new_url.file_type" class="mr-3 mt-3">File type</label>
                                        <div class="form-group">
                                            <div class="d-flex">
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" type="radio" v-model="new_url.file_type" v-bind:id="index" value="y">
                                                    <label class="form-check-label" for="radio1a">You Tube</label>
                                                </div>
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" type="radio" v-model="new_url.file_type" v-bind:id="index" value="p">
                                                    <label class="form-check-label" for="radio1a">Pod Cast</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" v-model="new_url.file_type" v-bind:id="index" value="w">
                                                    <label class="form-check-label" for="radio1a">Web page</label>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" type="radio" v-model="new_url.file_type" v-bind:id="index" value="s">
                                                    <label class="form-check-label" for="radio1a">Shared File</label>
                                                </div>
                                                <div class="form-check mr-2">
                                                    <input class="form-check-input" type="radio" v-model="new_url.file_type" v-bind:id="index" value="i">
                                                    <label class="form-check-label" for="radio1a">Image</label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label for="new_url.url" class="mr-3">URL</label>
                                            <textarea v-model="new_url.url" class="form-control"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <template v-if="index < 2">
                                                <i class="far fa-plus-square fa-2x mr-1" @click="add_url_form"></i>
                                            </template>
                                            <i class="far fa-minus-square fa-2x ml-1" @click="del_url_form(index)"></i>
                                        </div>
                                    </div>
                                    <div v-if="new_program_urls.length == 0" class="d-flex justify-content-center mb-2">
                                        <i class="far fa-plus-square fa-2x mr-1" @click="add_url_form"></i>
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
            new_program_urls: [],
            edit_type: '',
            program_id: ''
        },
        methods: {
            init_program_modal: function() {
                this.edit_type = 'create';
                this.new_program_urls = [{file_type: '', url: ''}];
            },
            add_url_form: function() {
                this.new_program_urls.push({file_type: '', url: ''});
            },
            del_url_form: function(index) {
                this.new_program_urls.splice( index, 1 );
            },
            submit_new_program: function() {
                axios
                .post('/program/store', {
                    id: this.program_id,
                    user_id: {{ Auth::user()->id }},
                    bookmark_id: {{ $bookmark->id }},
                    title: this.new_program_title,
                    comment: this.new_program_comment,
                    new_program_urls: this.new_program_urls,
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
                this.new_program_urls = Array.from(program.urls);
            },
            delete_program: function(program) {
                this.edit_type = 'delete';
                this.program_id = program.id;
                this.new_program_title = program.title;
                this.new_program_comment = program.comment;
                this.new_program_urls = program.urls;
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
                this.new_program_youtube_url = '';
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
