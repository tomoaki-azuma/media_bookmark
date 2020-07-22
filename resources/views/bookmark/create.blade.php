@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <h4>Create Media Bookmarks</h4>
            <div class="card mb-5">
                
                <form method="POST" action="/bookmark/store">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="comment">Description</label>
                        <textarea name="comment" class="form-control"></textarea>
                    </div>
                    <div class="row my-3 mx-2 d-flex justify-content-center">
                        <input type="submit" class="btn btn-primary" value="OK"">
                    <div class="mx-3"><a href="/home" class="btn btn-secondary" role="button">Cancel</a></div>
                    </div>
                    <input type="hidden" name="type" value="create">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('vuepart')

@endsection
