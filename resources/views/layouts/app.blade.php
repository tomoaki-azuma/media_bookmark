<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'My-mbm') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
   
    <!-- Font Awesome JS -->
    <script src="https://kit.fontawesome.com/410b2e5e4e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,900;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
    <style>
  
    </style>
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="text-right">
            <div class="align-right mx-2 mt-1">
                <i id="dismiss" class="fas fa-arrow-circle-left bg-primary"></i>
            </div>
            <div class="sidebar-header py-2">
                @if (Auth::user())
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage').'/'.$auth->img_url }}" class="rounded-circle" width="60" height="60">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="/user"> {{ $auth->name }} </a>
                </div>
                @endif
            </div>
            
            <ul class="list-group text-center mt-2">
                <li class="list-group-item"> 
                    <a href="/home" class="ml-2">
                        Edit My MBM
                    </a>
                </li>
                <li class="list-group-item"> 
                    <a href="/bookmark/share" class="ml-2">
                        <i class="far fa-list-alt　mr-2"></i>
                        Share MBM
                    </a>
                </li>
                <li class="list-group-item"> 
                    <a href="/logout" class="ml-2">
                        <i class="far fa-list-alt　mr-2"></i>
                        Logout
                    </a>
                </li>

            </ul>       
            
        </nav>
    
        <div id="content" class="">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
        
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fab fa-elementor fa-lg"></i>
                        MENU
                    </button>
                    <div>My-MBMロゴ</div>
                </div>
            </nav>

            <div class="content_wrapper mt-5 mx-3">
                @yield('content')
            </div>
        </div>
    </div>

    @yield('vuepart')
    
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        $('#dismiss').on('click', function () {
            $('#sidebar').removeClass('active');
        });
    </script>
</body>
</html>
