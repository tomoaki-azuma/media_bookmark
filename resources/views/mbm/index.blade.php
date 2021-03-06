@extends('layouts.app')

@php
    $shared_url = url('').'/mbm/'; 
@endphp

@section('ogp-matadata')
<meta property="og:title" content="{{ $bookmark->title }}"></meta>
<meta property="og:description" content="{{ $bookmark->comment }}"></meta>
<meta property="og:image" content="https://api.qrserver.com/v1/create-qr-code/?data={{ $shared_url.$bookmark->share_token }}&amp;size=200x200"></meta>
<meta property="twitter:card" content="summary"></meta>

@endsection

@section('bookmark-edit-header')
<div class="text-center mbm-header-logo">
<a href="/" target="_blank">
<img src="{{ asset('storage').'/common/logo_small.png' }}" width="130px">
</a>
</div>
<div class="d-flex mt-2">
    <div class="mx-3 w-100">
        <div class="my-1">
            <div class="bookmark-edit-title">{{ $bookmark->title }}</div>
        </div>
        <div class="my-2">
            <div class="bookmark-edit-comment">{{ $bookmark->comment }}</div>
        </div>
        <div class="d-flex justify-content-end">
            <div class="text-right">
                <div class="mbm-editor">
                editor: {{ $editor->name }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-2">
    <div class="my-2">
        <div class="sticky-top">        
            <div v-show="ytplay_flg">
                <div id="ytarea_wrapper" class="row d-flex justify-content-center bg-light my-2">
                    <div id="ytarea"></div>
                    <p @click="closeYT">
                    <i class="far fa-times-circle fa-2x"></i>
                    </p>
                </div>
            </div>
        </div>

        <template v-if="program_list.length > 0">
        <div class="">
            <button class="youtube-playall-button" @click="playYT_list"><i class="fab fa-youtube fa-lg mr-2" style="color: red;"></i>PlayAll</button>
        </div>
        </template>

        <div class="mt-3">

            <div v-for="(data, index) in searched_program" class="mbm-link-wrapper border border-left-0 border-right-0 border-top-0 my-1 py-1 mx-1 px-0 pt-2">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        <template v-if="is_youtube_url(data['url'])" >
                            <div class="url-title" @click="playYT(data['url'])">
                                <a href="javascript:void(0)">
                                @{{ data['title'] }} 
                                <img src="{{ asset('storage').'/common/yt_logo.png' }}">
                                </a>
                            </div>
                        </template>
                        <template v-else>
                            <div class="url-title">
                                <a v-bind:href="data['url']" target="_blank" rel="noopener noreferrer">
                                @{{ data['title'] }} 
                                </a>
                            </div>
                        </template>
                    </div>
                    <div class="w-25 mx-2">
                        <template v-if="is_youtube_url(data['url'])" >
                            <div @click="playYT(data['url'])">
                                <img v-bind:src="data['thumbnail_img']" class="img-fluid">
                            </div>
                        </template>
                        <template v-else>
                            <div>
                                <a v-bind:href="data['url']" target="_blank" rel="noopener noreferrer">
                                    <img v-bind:src="data['thumbnail_img']" class="img-fluid">
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="url-comment my-3">
                    <div class="card card-body p-2">
                    @{{ data['comment'] }}
                    <div class="url-link mt-2">
                    <a v-bind:href="data.url" target="_blank">@{{ shorten_url(data['url']) }}</a> 
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('modal-contents')

<div class="modal fade" id="aboutModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header bg-warning text-white">
                <h4 class="modal-title">Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="m-3">
                <div class="my-3">
                    <h5 class="book_title my-2">About {{ $bookmark->title }} </h5>
                    <div>
                        {{ $bookmark->comment }}
                    </div>
                </div>
                <div class="my-3">
                    <h5 class="book_title my-2">Editor</h5>
                    <div class="d-flex justify-content-center my-4">
                        <div class="text-center">
                            <div>
                                @if (preg_match('/^http(.+)/', $editor->img_url))
                                    <img src="{{ $editor->img_url }}" class="rounded-circle" width="60" height="60">
                                @else
                                    <img src="{{ asset('storage').'/avatars/avatardefault.png' }}" class="rounded-circle" width="60" height="60">
                                @endif
                            </div>
                            <div>
                                {{ $editor->name }}
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="my-3">
                    <h5 class="book_title my-2">FROM My-MBM</h5>
                    <div class="px-3">
                        自分の好きをシェアしよう
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('vuepart')
<script src="https://www.youtube.com/iframe_api"></script>
<script>
let vm = new Vue({
    el: '#app',
    data: {
        program_data: [],
        ytplay_flg: false,
        cur_video_id: "",
        themes: [],
        searched_program: [],
        sort_flg: 'd',  // ascending or decending
        search_keyword: "",
        qr_code_url: "",
        program_list: []
    },
    methods: {
        playYT_list: function() {
            console.log(this.program_list);
            this.ytplay_flg = true;
            ytPlayer.cuePlaylist({
                listType: 'playlist',
                playlist: this.program_list,
                index: 0
            });
        },
        playYT: function(url) {
            video_id = this.get_youtube_program_id(url);
            this.ytplay_flg = true;
            this.cur_video_id = video_id;
            console.log(video_id);
            ytPlayer.cueVideoById({videoId: video_id});           
        },
        closeYT: function() {
            ytPlayer.stopVideo();
            this.ytplay_flg = false;
        },
        episode_num: function(num){
            if (num.indexOf('ex.')) {
                return '#' + Number(num)
            } else {
                return '#ex.' + Number(num.substr(3)) 
            }
        },
        search_by_keyword: function() {
            this.searched_program = this.program_data.filter( function( value, index, array ) {
                 return value.title.indexOf(this.search_keyword) >= 0;       
            }, this)
        },
        display_all: function(p_no) {
            this.searched_program = this.program_data
            this.sort_program(this.sort_flg)
        },
        sort_program: function() {
            this.searched_program.sort(function(a,b){
                if( a.delivery_date < b.delivery_date ) {
                    return -1;
                } else if( a.delivery_date > b.delivery_date ) {
                    return 1;
                } else {
                    if (a.num < b.num) {
                        return -1;
                    } else {
                        return 1;
                    }
                }
            });
            if (this.sort_flg === 'd') {
                this.searched_program = this.searched_program.reverse();
            }
        },
        sort_change: function() {
            if (this.sort_flg === 'd') {
                this.sort_flg = 'a';
            } else {
                this.sort_flg = 'd';
            }
            this.sort_program(this.sort_flg);
        },
        is_youtube_url: function(url) {
            re = /^https?:\/\/www\.youtube\.com\/watch\?v=(.{11})/;
            result1 = re.exec(url);
            
            if (result1) {
                return true;
            }
            re2 = /^https?:\/\/youtu\.be\/(.{11})/;
            result2 = re2.exec(url);
            
            if (result2) {
                return true;
            }
            
            re3 = /^https?:\/\/m.youtube.com\/watch\?v=(.{11})/;
            result3 = re3.exec(url);
            if (result3) {
                return true;
            }

            return false;
        },
        get_youtube_program_id: function(url) {
            re = /^https?:\/\/www\.youtube\.com\/watch\?v=(.{11})/;
            result1 = re.exec(url);
            if (result1) {
                return result1[1];
            }

            re2 = /^https?:\/\/youtu\.be\/(.{11})/;
            result2 = re2.exec(url);
            if (result2) {
                console.log(result2);
                return result2[1];
            }


            re3 = /^https?:\/\/m.youtube.com\/watch\?v=(.{11})/;
            result3 = re3.exec(url);
            if (result3) {
                console.log(result3);
                return result3[1];
            }

        },
        shorten_url: function(url) {
            MAX_LENGTH = 50;
            if (url.length > MAX_LENGTH) {
                return url.substr(0, MAX_LENGTH) + '  ...';
            } else {
                return url;
            }
        }
    },
    computed: {

    },
    mounted: function() {
        axios
            .get('/mbm/programs/' + {{ $bookmark->id}})
            .then( response => {
                this.program_data = response.data;
                for (p of this.program_data) {
                    if (this.is_youtube_url(p['url'])) {
                        yid = this.get_youtube_program_id(p['url']);
                        this.program_list.push(yid);
                    }
                }
                this.searched_program = this.program_data
                this.display_all(this.sort_flg)
            })    
            .catch(function(error) {
                console.log(error);
            });
    },
    created: function () {
       this.qr_code_url = `https://api.qrserver.com/v1/create-qr-code/?data={{ $bookmark->shared_url }}&amp;size=200x200`;
    }
})

// YouTube Player APIを読み込む
let tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let ytPlayer;
let yt_window_size = window.innerWidth;
if (yt_window_size >= 600) {
    yt_window_size = 600;
}

let yt_window_height = yt_window_size * 0.6;

// API読み込み後にプレーヤー埋め込み
// When You Tube API is ready, create a new 
// You Tube player in the div with id 'player'
function onYouTubeIframeAPIReady() {
    ytPlayer = new YT.Player('ytarea', 
      {
          videoId: '',   // Load the initial video
          width: yt_window_size,
          height: yt_window_height,
          playerVars: {
                 autoplay: 0,      // Don't autoplay the initial video
                 rel: 0,           //  Don’t show related videos
                 theme: "light",   // Use a light player instead of a dark one
                 controls: 1,      // Show player controls
                 showinfo: 0,      // Don’t show title or loader
                 modestbranding: 0 // No You Tube logo on control bar
          }
      });
  
}

</script>
@endsection