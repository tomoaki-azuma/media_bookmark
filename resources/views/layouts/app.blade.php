<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Media Bookmark</title>
        @yield('ogp-matadata')
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet"> 
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- FontAweSome ICON -->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <style>

        </style>
</head>
<body>
    @if (preg_match('/bookmark\/edit\//', request()->path()))
        <div id="app" class="d-flex justify-content-center my-2 mx-2" v-cloak>
            <div class="col-xs-6 col-xl-6 col-lg-6 p-0 bookmark-wrap-card ">
                <div class="edit-header-wrap text-white py-1">
                @yield('bookmark-edit-header')
                </div>
                
                @yield('content')

                @yield('modal-contents')
            </div>
        </div>
    @elseif (request()->path() == '/')
        <div id="app" class="container-fluid d-flex justify-content-center p-0 m-0" v-cloak>
            <div class="col-xs-6 col-xl-6 col-lg-6 p-0">
                <div class="text-center">
                    <img class="img-fluid" src="{{ asset('storage').'/common/toplogo.png' }}" alt="">
                </div>
                
                @yield('content')

                @yield('modal-contents')
            </div>
        </div>
    @elseif (preg_match('/mbm\//', request()->path()))
        <div id="app" class="d-flex justify-content-center my-2 mx-2" v-cloak>
            <div class="col-xs-6 col-xl-6 col-lg-6 p-0 bookmark-wrap-card ">
                <div class="mbm-header-wrap text-white pb-1">
                @yield('bookmark-edit-header')
                </div>
                
                @yield('content')

                @yield('modal-contents')
            </div>
        </div>
    @else
        <div id="app" class="container-fluid d-flex justify-content-center p-0" v-cloak>
            <div class="col-xs-6 col-xl-6 col-lg-6 p-0">
                <div class="d-flex justify-content-center header-wrap text-white py-1 sticky-top">
                @if (preg_match('/login|reset|register|verify|privacy_policy|terms_of_use|about_us|help/', request()->path()))
                    <a href="/"> 
                    <img class="my-2" src="{{ asset('storage').'/common/logo1-2.png' }}" alt="" height="20px">
                    </a>
                @else
                    <img class="my-2" src="{{ asset('storage').'/common/logo1-2.png' }}" alt="" height="20px">
                @endif

                </div>

                @yield('content')

                @yield('modal-contents')
            </div>
        </div>
    @endif
    <script defer src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- vue JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @yield('vuepart')
</body>
</html>
