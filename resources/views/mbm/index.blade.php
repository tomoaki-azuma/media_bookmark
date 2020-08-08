
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My-MBM:{{ $bookmark->title }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <style>
            html {
                font-size: 14px; /* ルート要素のフォントサイズを1rem=14pxと定義する */
            }

            .card {
                cursor: pointer;
                font-size: 10px;
            }

            .book_title { 

                /*線の種類（二重線）太さ 色*/
                border-bottom: double 5px #FFC778;

            }

            [v-cloak] {
                display: none;
            }
            
        </style>
    </head>
    <body>
    
        <div class="container-fluid d-flex justify-content-center p-0">
            <div class="col-xs-12 col-xl-6 col-lg-8">
                <div class="">
                    <div id="app">
                        
                        <div class="sticky-top ">
                            <div class="row d-flex justify-content-between bg-primary text-white p-2">
                                <div><h5 class="ml-1">{{ $bookmark->title }}</h4></div>
                                <div class="mx-3">
                                    <i class="fas fa-info-circle fa-2x" data-toggle="modal" data-target="#aboutModal"></i>
                                </div>
                            </div>
                            <div class="mx-3">
                                <div class="row mt-3">
                                    <div class="row mr-auto">
                                        <div class="row ml-3">
                                            <input type="text" v-model="search_keyword" @input="search_by_keyword" placeholder="search title">
                                            <div class="ml-2"><i class="fas fa-sort fa-2x" @click="sort_change()"></i></div>
                                        </div>
                                    </div>
                                    <div>
                                        editor: {{ $editor->name}}
                                    </div>
                                    
                                </div>
                            </div>
                            
                                
                            <div v-show="ytplay_flg">
                                <div id="ytarea_wrapper" class="row d-flex justify-content-center bg-light my-2">
                                    <div id="ytarea"></div>
                                    <p @click="closeYT">
                                    <i class="far fa-times-circle fa-2x"></i>
                                    </p>
                                </div>
                            </div>
                        </div>

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

                        <div class="mt-3">
                            <div v-for="data in searched_program" class="d-flex justify-content-between border-top my-2 py-1 pl-2">
                                <div>
                                    <div class="col mt-1 px-0">
                                        <div class="row">
                                            <div class="text-left px-0" v-cloak>@{{ data['title'] }}
                                                <template v-if="is_youtube_url(data['url'])" >
                                                    <i class="text-danger fab fa-youtube fa-x"></i>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col mt-1 px-0">
                                        <div class="text-left px-0" v-cloak>
                                            <a v-bind:href="data['url']" target="_blank" rel="noopener noreferrer">@{{ data['url']}}</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="d-flex justify-content-end align-self-end ml-3">
                                    <template v-if="is_youtube_url(data['url'])" >
                                        <div @click="playYT(data['url'])">
                                            <img v-bind:src="data['thumbnail_img']" width="100" height="75">
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div>
                                            <a v-bind:href="data['url']" target="_blank" rel="noopener noreferrer">
                                                <img v-bind:src="data['thumbnail_img']" class="img-thumbnail" width="100" height="75">
                                            </a>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
            
                        
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- Popper JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>    

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




    </body>
</html>