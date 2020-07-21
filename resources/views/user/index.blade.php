@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="">
        <div class="row-fluid mx-1">
            <div id="bg-warning">
                    <div class="flex-fill">
                        <div class="mx-2 mt-2 text-center" >
                            
                        </div>
                        <div class="flex-fill d-flex justify-content-center">
                            <div class="col-md-10 col-lg-8">
                                <h4>Profile</h4>
                                <div class="d-flex mt-3">
                                    <div class="col-3">
                                        Name :
                                    </div>
                                    <div class="col-8">
                                        {{ $auth->name }}
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="col-3">
                                        avatar :
                                    </div>
                                    <div class="col-8">
                                        <img src="{{ $auth->img_url }}" class="rounded-circle" width="60" height="60">
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="col-3">
                                        mail :
                                    </div>
                                    <div class="col-8">
                                        {{ $auth->email }}
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <div class="col-3">
                                        message :
                                    </div>
                                    <div class="col-8">
                                        {{ $auth->comment }}
                                    </div>
                                </div>
                                <div class="d-flex mt-3">
                                    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm" @click="pop_modal">Edit</button>
                                    <div class="mx-3"><a href="/home" class="btn btn-secondary" role="button">Back</a></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>          
            </div>
        </div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profile</h5>
                        <button id="modal_close_btn" type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="tab-content mx-3">
                        <div class="tab-pane active">
                            <form method="POST" action="/user/store" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="new_program_title" class="mr-3">name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $auth->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="new_program_comment" class="mr-3">image</label>
                                    <input type="file" name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="new_program_youtube_url" class="mr-3">Comment</label>
                                    <textarea name="comment" class="form-control">{{ $auth->comment }}</textarea>
                                </div>
                                <div class="row my-3 mx-2 d-flex justify-content-center">
                                    <div class="mx-1">
                                        <input type="submit" class="btn btn-primary" value="OK">
                                    </div>
                                    <div class="mx-1">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
    
@endsection

@section('vuepart')

@endsection