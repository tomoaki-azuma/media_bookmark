@extends('layouts.app')

@section('content')

<div class="my-3 text-center function-title">
   Profile 
</div>
<div id="profile-card" class="d-flex mt-2 mx-2 " v-cloak>
	<div class="profile-img px-4" v-cloak>
        <template v-if="img_url === '' || img_url === null" v-cloak>
            <img src="{{ asset('storage').'/avatars/avatardefault.png' }}" class="rounded-circler" width="80" height="80">
        </template>
        <template v-else v-cloak>    
            <img v-bind:src="img_url" class="rounded-circle" width="60" height="60" v-cloak>
        </template>
    </div>
    <div class="profile-box">
        <div class="profile-name mt-3 ml-2" v-cloak>
            @{{ name }}
        </div>
        <div class="profile-comment ml-2 mt-3" v-cloak>
        @{{ comment }}
        </div>
    </div>
    
</div>

<div class="d-flex justify-content-center my-3">
    <button type="" data-toggle="modal" data-target="#myModal" class="submit-button" @click="init_modal_data">Edit</button>
</div>
<div class="d-flex justify-content-center my-3">
    <a href="/logout">
        <button class="submit-button logout-button">Logout</button>
    </a>
</div>
@include('layouts.contents-footer', ['current' => 'profile'])
</div>
@endsection

@section('modal-contents')
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
                    <div class="form-group">
                        <label for="new_name" class="mr-3">name</label>
                        <input type="text" v-model="new_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_img_url" class="mr-3">image(URL)</label>
                        <input type="text" v-model="new_img_url" class="form-control">
                    </div>
                    <div class="text-center">
                        <template v-if="new_img_url === '' || new_img_url === null">
                            <img src="{{ asset('storage').'/avatars/avatardefault.png' }}" class="rounded-circle" width="80" height="80">
                        </template>
                        <template v-else>    
                            <img v-bind:src="new_img_url" class="rounded-circle" width="80" height="80">
                        </template>
                    </div>
                    <div class="form-group">
                        <label for="new_comment" class="mr-3">Comment</label>
                        <textarea v-model="new_comment" class="form-control"></textarea>
                    </div>
                    <div class="row my-3 mx-2 d-flex justify-content-center">
                        <div class="mx-1">
                            <input type="button" class="btn btn-primary" value="OK" @click="submit_user_update">
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
            new_name: '',
            new_img_url: '',
            new_comment: '',
            email: '',
            name: '',
            img_url: '',
            comment: '',
        },
        methods: {
            init_modal_data: function() {
                this.new_name = this.name;
                this.new_comment = this.comment;
                this.new_img_url = this.img_url;
            },
            submit_user_update: function() {
                axios
                .post('/user/store', {
                    name: this.new_name,
                    comment: this.new_comment,
                    img_url: this.new_img_url,
                })
                .then( response => {
                    this.name = response.data.name;
                    this.img_url = response.data.img_url;
                    this.comment = response.data.comment;
                    this.email = response.data.email;
                    this.init_modal_data();
                    $("#modal_close_btn").click();
                })    
                .catch(function(error) {
                    console.log(error);
                });
            },
        },
        created: function() {
            this.name = '{{ $auth->name }}';
            this.img_url = '{{ $auth->img_url }}';
            this.email = '{{ $auth->email }}';
            this.comment = '{{ $auth->comment }}';
        }
    })
</script>
@endsection