@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <h4>Share Your MBM</h4>
            <div class="mb-5">
                <div class="card mb-5">
                    
                    <div class="card-header">
                        <div class="d-flex row">
                            <div class="mr-auto"><i class="fas fa-search mx-2"></i><input type="text"></div>
                        </div>
                        
                    </div>
                    <div class="card-block p-0">
                        <table class="table table-bordered table-sm m-0">
                            <thead class="bg-warning">
                                <tr>
                                    <th class="text-center">Title(Link)</th>
                                    <th class="text-center">Comment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="bookmark in bookmarks">
                                    <tr>
                                        @php
                                            // $shared_url = 'http://:8000/mbm/' // 要変更！
                                            $shared_url = 'http://http://my-mbm.sakura.tv/mbm/'
                                        @endphp
                                        <td><a v-bind:href="'{{ $shared_url }}' + bookmark.share_token" target="_blank">@{{ bookmark.title }}</a></td>
                                        <td>@{{ bookmark.comment }}</td>
                                        <td class="">
                                            <i class="fab fa-facebook"></i>
                                            <i class="fab fa-twitter"></i>
                                            <i class="fas fa-qrcode" data-toggle="modal" data-target="#qrModal" @click="create_qr_code(bookmark.share_token)"></i>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="qrModal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="text-center my-3">
                            <img v-bind:src="qr_code_url" width="200" height="200" alt="" title="" /> 
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
            bookmarks: [],
            qr_code_url: ''
        },
        methods: {
            date_format: function(date) {
                d = new Date(date);
                console.log(d);
                return d.getFullYear() + '/' + (d.getMonth()+1) + '/' + d.getDate();
            },
            create_qr_code: function(token) {
		shared_url = '{{ $shared_url }}' + token;
		this.qr_code_url = `https://api.qrserver.com/v1/create-qr-code/?data=${shared_url}&amp;size=200x200`;
            }
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
