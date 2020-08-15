@extends('layouts.app')

@section('content')
<div>
    
    <div class="">
            <div class="my-2 text-center">
            <h5>My Media Bookmarks</h5>
            </div>
            <div class="text-right mt-1 mr-2">
                <a href="/bookmark/create">
                    <img class="" src="{{ asset('storage').'/common/ic_add_circle.png' }}" width="20px">
                </a>
            </div>
    </div>
    
    <div class="d-flex justify-content-between border-bottom mt-2 pb-2" v-for="(bookmark,index) in bookmarks">
        @php
            $shared_url = url('').'/mbm/'; 
        @endphp
        <div class="ml-2 align-top w-80">
            <div class="bookmark-title w-100">
                @{{ bookmark.title }}
            </div>
                <!-- <a class="" data-toggle="collapse" v-bind:href="'#collapseExample'+index" aria-expanded="false" v-bind:aria-controls="'collapseExample'+index">
                <img src="{{ asset('storage').'/common/ic_more.png' }}">
                </a>
                <div class="collapse url-comment" v-bind:id="'collapseExample'+index"> -->
                <div class="bookmark-comment">
                    @{{ bookmark.comment }}
                </div>
                <!-- </div>                           -->
        </div>
        <div class="mx-2 my-auto w-20">
            <a v-bind:href="'/bookmark/edit/'+bookmark.id">
                <img class="" src="{{ asset('storage').'/common/ic_arrow.png' }}">
            </a>
        </div>
    </div>
    <div><br> <br> <br> <br> </div>
    @include('layouts.contents-footer', ['current' => 'home'])
</div>
@endsection

@section('modal-contents')
<div class="modal fade" id="share-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
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
@endsection

@section('vuepart')
<script>
    let vm = new Vue({
        el: '#app',
        data: {
            bookmarks: [],
            modal_title: '',
            modal_comment: '',
            qr_code_url: '',
            shared_url: ''

        },
        methods: {
            date_format: function(date) {
                d = new Date(date);
                console.log(d);
                return d.getFullYear() + '/' + (d.getMonth()+1) + '/' + d.getDate();
            },
            create_modal_data: function(bookmark) {
                this.modal_title =bookmark.title;
                this.modal_comment = bookmark.comment;
                shared_url = '{{ $shared_url }}' + bookmark.share_token;
                this.shared_url = shared_url;
                this.qr_code_url = `https://api.qrserver.com/v1/create-qr-code/?data=${shared_url}&amp;size=200x200`;
            },
            copy_clipboard: function() {
                var copyTarget = document.getElementById("copy-target");
                copyTarget.select();
                document.execCommand("Copy");
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
