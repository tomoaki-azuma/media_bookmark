@extends('layouts.app')

@section('content')
<div id="profile-card" class="mt-4 mx-3 pb-4">
    <div class="profile-title my-2 py-2">
	Profile
    </div>
	<div class="profile-img text-center my-3">
        <template v-if="img_url === '' || img_url === null">
            <img src="{{ asset('storage').'/avatars/avatardefault.png' }}" class="rounded-circler" width="80" height="80">
        </template>
        <template v-else>    
            <img v-bind:src="img_url" class="rounded-circle" width="80" height="80">
        </template>
    </div>
    <div class="text-center profile-name mb-3">
        @{{ name }}
    </div>
	<div class="profile-comment mx-5">
	@{{ comment }}
	</div>
	<div class="d-flex justify-content-around mx-3 my-4">
        <button type="" data-toggle="modal" data-target="#myModal" class="profile-button" @click="init_modal_data">Edit</button>
        <a href="/logout">
            <button class="profile-button">Logout</button>
        </a>
    </div>
    
    @include('layouts.contents-footer', ['current' => 'profile'])
</div>

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