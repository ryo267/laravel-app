<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="user-id" content="{{ Auth::user()->id }}">
    <meta name="user-email" content="{{ Auth::user()->email }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/f8f423cc2c.js" crossorigin="anonymous"></script>
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--<script src="{{ asset('js/company/three.js') }}" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/studyService.css') }}" rel="stylesheet">

</head>

<body>
    <div class="loading" id="loading">
        <div class="border-loading-indicator col-2 row-2"></div>
    </div>

    <div class="video_container">
		<video src="/movie/Network12716.mp4" playsinline autoplay muted loop></video>
    </div>
    
    <div class="container-fluid p-0 m-0" id="app">
        @section('side_nav')
        <section class="said_nav" id="said_nav">

            <div class="r_nav" id="r_nav">
                <div class="r_icon_wrap" id="r_icon_wrap"><i class="far fa-id-card"></i></div>
            </div>
            <div class="r_nav_2" id="r_nav_2">
                <company-profile-component />
            </div>

            <div class="o_nav" id="o_nav">
                <div class="o_icon_wrap" id="o_icon_wrap"><i class="fas fa-pen-nib"></i></div>
            </div>
            <div class="o_nav_2" id="o_nav_2">
                <company-form-component />
            </div>

            <div class="b_nav" id="b_nav">
                <div class="b_icon_wrap" id="b_icon_wrap"><i class="fas fa-building"></i></div>
            </div>
            <div class="b_nav_2" id="b_nav_2">
                <infos-component />
            </div>

            <div class="p_nav" id="p_nav">
                <div class="p_icon_wrap" id="p_icon_wrap"><i class="fas fa-mail-bulk"></i></i></div>
            </div>
            <div class="p_nav_2" id="p_nav_2">
                <div class="container-fluid h-100">
                    <google-form-component />
                </div>
            </div>

            <div class="g_nav" id="g_nav">
                <div class="g_icon_wrap" id="g_icon_wrap"><i class="fas fa-sms"></i></div>
            </div>
            <div class="g_nav_2" id="g_nav_2">
                <chat-component />
            </div>

        </section>
        @show

        <section class="said">

        </section>

        <section class="main vh-100 overflow-auto">

            @section('h_nav')
            <section class="header">
                <nav class="h_nav navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/home">LOGO</a>
                    <button class="navbar-toggler mr-3" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <!-- Authentication Links -->
                            @guest
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="search_form form-control mr-sm-2" type="search" placeholder="Search">
                            <button class="search_button btn" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </nav>
            </section>
            <div class="box" style="height: 80px;"></div>
            @show
                    
            <section id="canvas"></section>


            <!--
            <section class="my-3">
                <users-component/>
            </section>
                    -->
            
            <section class="my-5">
                <tab-component />
            </section>


            @section('footer')
            <section class="footer">
                <div class="container-fluid text-white f_navi">
                    <div class="row">
                        <div class="col text-center">
                            <div class="sns_wrap mx-auto">
                                <ul class="sns d-flex justify-content-between p-0">
                                    <li><i class="fab fa-twitter-square fa-2x"></i></li>
                                    <li><i class="fab fa-facebook-square fa-2x"></i></li>
                                    <li><i class="fab fa-instagram fa-2x"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h5 class="text-center m-0">COPYRIGHT</h5>
                </div>
            </section>
            @show


        </section>
    </div>
</body>

</html>