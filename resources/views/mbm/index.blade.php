@extends('layouts.app')

@section('content')
<div class="px-2">
    <div class="my-2">
        <div class="">
            <div class="d-flex justify-content-center mt-2">
                <div><h5>{{ $bookmark->title }}</h5></div>
                
            </div>
            <!-- <div class="mx-3">
                <div class="row mt-3">
                    <div class="row mr-auto">
                        <div class="row ml-3">
                            <input type="text" v-model="search_keyword" @input="search_by_keyword" placeholder="search title">
                            <div class="ml-2"><i class="fas fa-sort fa-2x" @click="sort_change()"></i></div>
                        </div>
                    </div>
                    
                </div>
            </div> -->
            
            <div class="text-right">
                <div>
                editor: {{ $editor->name }}
                </div>
            </div>
        </div>
        <div class="sticky-top">        
            <div v-show="ytplay_flg">
                <div id="ytarea_wrapper" class="row d-flex justify-content-center bg-light my-2">
                    <div id="ytarea"></div>
                    <p @click="closeYT">
                    
                        <button id="b_modal_close_btn" type="button" class="close p-3">&times;</button>
                    <i class="far fa-times-circle fa-2x"></i>
                    </p>
                </div>
            </div>
        </div>


        <div class="mt-3">

            <div v-for="(data, index) in searched_program" class="border border-left-0 border-right-0 border-top-0 my-1 py-1 mx-1 px-0">
                <div class="d-flex justify-content-between">
                    <div class="w-75">
                        <div class="url-title">
                            @{{ data['title'] }} 
                            <template v-if="is_youtube_url(data['url'])" >
                                <img src="{{ asset('storage').'/common/yt_logo.png' }}">
                            </template>
                        </div>
                        <div class="">
                            <div class="d-flex justify-content-between">
                                <div class="p-2" data-toggle="collapse" v-bind:href="'#collapseExample'+index" aria-expanded="false" v-bind:aria-controls="'collapseExample'+index">
                                <img src="{{ asset('storage').'/common/ic_more.png' }}">
                                </div>
                                <div class="p-2">
                                </div>
                            </div>
                            <div class="collapse url-comment" v-bind:id="'collapseExample'+index">
                                <div class="card card-body">
                                @{{ data['comment'] }}
                                <div class="url-link mt-2">
                                <a v-bind:href="data.url" target="_blank">@{{ data['url']}}</a> 
                                </div>
                                </div>
                            </div>                          
                        </div>
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
                                    <img v-bind:src="data['thumbnail_img']" class="img-fluid img-thumbnail">
                                </a>
                            </div>
                        </template>
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
                                    <img src="{{ asset('storage').'/'.$editor->img_url }}" class="rounded-circle" width="60" height="60">
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
        search_keyword: ""
    },
    methods: {
        playYT: function(url) {
            video_id = this.get_youtube_program_id(url);
            this.ytplay_flg = true;
            this.cur_video_id = video_id;
            console.log(video_id);
            //ytPlayer.cueVideoById(video_id.replace('/watch?v=', ''));{videoId: videoId}
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

        },
    },
    computed: {

    },
    mounted: function() {
        axios
            .get('/mbm/programs/' + {{ $bookmark->id}})
            .then( response => {
                this.program_data = response.data;
                this.searched_program = this.program_data
                this.display_all(this.sort_flg)
            })    
            .catch(function(error) {
                console.log(error);
            });
    },
    created: function () {
        
        
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
          videoId: 'FvCf8xYLYuA',   // Load the initial video
          width: yt_window_size,
          height: yt_window_height,
          playerVars: {
                 autoplay: 0,      // Don't autoplay the initial video
                 rel: 0,           //  Don’t show related videos
                 theme: "light",   // Use a light player instead of a dark one
                 controls: 1,      // Show player controls
                 showinfo: 0,      // Don’t show title or loader
                 modestbranding: 1 // No You Tube logo on control bar
          }
      });
  
}

</script>
@endsection