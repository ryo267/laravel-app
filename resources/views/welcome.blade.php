<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/welcome.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/diamonds.css') }}" rel="stylesheet">
</head>


<body>
    <section id="canvas"></section>

    <div class="video_container">
        <video src="/movie/Welcome24829.mp4" playsinline autoplay muted></video>
    </div>

    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="" id="login">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <div>
        @if (Route::has('company.login'))
        <div class="" id="login">
            @auth
            <a href="{{ url('/company_home') }}">Home</a>
            @else
            <a href="{{ route('company.login') }}">Login</a>

            @if (Route::has('company.register'))
            <a href="{{ route('company.register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <div id="app">
        <welcome-component />
    </div>

</body>

</html>