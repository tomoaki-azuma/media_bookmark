<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Media Bookmark</title>
        <meta property="og:title" content="Media Bookmark">
        <meta property="og:description" content="Media Bookmark Toppage">
        <meta property="og:image" content="{{ asset('storage').'/common/toppage.gif' }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&display=swap" rel="stylesheet"> 
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

        <style>

        </style>
</head>
<body>

    <div id="app" class="container-fluid d-flex justify-content-center p-0">
        <div class="col-xs-12 col-xl-6 col-lg-8 p-0">
            <div class="d-flex justify-content-center header-wrap py-1 sticky-top">
                <div>
                Media Bookmark
                </div>

            </div>

            @yield('content')

            @yield('modal-contents')
        </div>
    </div>


            {{-- <!-- <div class="sidebar-header py-2"> -->
                // @if (Auth::user()
                <!-- <div class="d-flex justify-content-center"> -->
                //    <!-- @if (preg_match('/^http(.+)/', $auth->img_url)) -->
                        <!-- <img src="{{ $auth->img_url }}" class="rounded-circle" width="60" height="60"> -->
                    <!-- @else -->
                        <!-- <img src="{{ asset('storage').'/'.$auth->img_url }}" class="rounded-circle" width="60" height="60"> -->
                //    <!-- @endif -->
                <!-- </div> -->
                <!-- <div class="d-flex justify-content-center"> -->
                    <!-- <a href="/user"> {{ $auth->name }} </a> -->
                <!-- </div> -->
                //<!-- @endif -->
            <!-- </div> --> --}}
    
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
