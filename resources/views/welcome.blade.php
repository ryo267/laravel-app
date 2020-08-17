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
    <script src="https://kit.fontawesome.com/f8f423cc2c.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/diamonds.css') }}" rel="stylesheet">
</head>


<body>

    <div class="section_wrap">
        <div class="section1">
            <div class="wrap">
                <div class="cover active" id="cover"></div>
                <div id="matrix" class="matrix"></div>
            </div>
            <ul>
                <li class="user_contents_wrap active" id="user_contents_wrap">
                    <div class="user_content" id="user_content">
                        <h3 class="title mt-5">「駆け出しエンジニア」<br>のための質問投稿サイト</h3>
                        <div class="w-50 mt-5 mx-auto d-flex justify-content-between">
                            <div class="button" id="register_btn">新規登録</div>
                            <div class="button" id="login_btn">ログイン</div>
                        </div>
                        <div class="mt-5" id="companies">
                            <i class="far fa-building fa-3x"></i>
                            <p>企業の方はこちら<i class="fas fa-arrow-right ml-3"></i></p>
                        </div>
                    </div>
                </li>
                <li class="compnay_container_wrap" id="compnay_container_wrap">
                    <div class="login-form p-5 company_login active" id="company_login">
                        <div class="background"></div>
                        <div class="user_icon"><i class="far fa-building fa-4x"></i></div>
                        <div class="">

                            <div class="">
                                <form method="POST" action="{{ route('company.login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <label for="email" class="col col-form-label">{{ __('E-Mail Address') }}</label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" type="email" class="form{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <label for="password" class="col col-form-label">{{ __('Password') }}</label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="password" type="password" class="form{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col">
                                            <button type="submit" class="btn">
                                                {{ __('Login') }}
                                            </button>

                                            <!--
                                    @if (Route::has('password.request'))
                                    <a class="btn pt-3 px-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="register-form p-5 company_register" id="company_register">
                        <div class="background"></div>
                        <div class="user_icon"><i class="far fa-building fa-4x"></i></div>
                        <div class="">

                            <div class="">
                                <form method="POST" action="{{ route('company.register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="screen_name" class="col-form-label">{{ __('Account Name') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="screen_name" type="screen_name" class="form{{ $errors->has('screen_name') ? ' is-invalid' : '' }}" name="screen_name" value="{{ old('screen_name') }}" required>

                                                    @if ($errors->has('screen_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('screen_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name" class="col-form-label ">{{ __('Name') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="name" type="text" class="form{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" type="email" class="form{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password" class="col-form-label ">{{ __('Password') }}</label>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="password" type="password" class="form{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="password-confirm" type="password" class="form" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-5">
                                        <div class="col">
                                            <button type="submit" class="btn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="section2">
            <div class="wrap2">
                <div class="cover2" id="cover2"></div>
                <div id="matrix2" class="matrix2 active"></div>
            </div>
            <ul>
            <li class="user_container_wrap active" id="user_container_wrap">
                    <div class="login-form p-5 login active" id="login">
                        <div class="background"></div>
                        <div class="user_icon"><i class="fas fa-user fa-4x"></i></div>
                        <div class="">

                            <div class="">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <label for="email" class="col col-form-label">{{ __('E-Mail Address') }}</label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" type="email" class="form{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <label for="password" class="col col-form-label">{{ __('Password') }}</label>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="password" type="password" class="form{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col">
                                            <button type="submit" class="btn">
                                                {{ __('Login') }}
                                            </button>

                                            <!--
                                    @if (Route::has('password.request'))
                                    <a class="btn pt-3 px-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="register-form p-5 register" id="register">
                        <div class="background"></div>
                        <div class="user_icon"><i class="fas fa-user fa-4x"></i></div>
                        <div class="">

                            <div class="">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="screen_name" class="col-form-label">{{ __('Account Name') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="screen_name" type="screen_name" class="form{{ $errors->has('screen_name') ? ' is-invalid' : '' }}" name="screen_name" value="{{ old('screen_name') }}" required>

                                                    @if ($errors->has('screen_name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('screen_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name" class="col-form-label ">{{ __('Name') }}</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <input id="name" type="text" class="form{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                                    @if ($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="email" class="col-form-label ">{{ __('E-Mail Address') }}</label>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="email" type="email" class="form{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password" class="col-form-label ">{{ __('Password') }}</label>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="password" type="password" class="form{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="password-confirm" class="col-form-label ">{{ __('Confirm Password') }}</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <input id="password-confirm" type="password" class="form" name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-5">
                                        <div class="col">
                                            <button type="submit" class="btn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="company_contents_wrap" id="company_contents_wrap">
                    <div class="company_content" id="user_content">
                        <h3 class="title mt-5">「駆け出しエンジニア」<br>を見つける質問投稿サイト</h3>
                        <div class="w-50 mt-5 mx-auto d-flex justify-content-between">
                            <div class="button" id="company_register_btn">新規登録</div>
                            <div class="button" id="company_login_btn">ログイン</div>
                        </div>
                        <div class="mt-5" id="users">
                            <i class="fas fa-user fa-3x"></i>
                            <p><i class="fas fa-arrow-left mr-3"></i>利用者の方はこちら</p>
                        </div>
                    </div>
                </li>
            </ul>

            <!--@if (Route::has('login'))
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
        @if (Route::has('company/login'))
        <div class="" id="login">
            @auth
            <a href="{{ url('/company_home') }}">Home</a>
            @else
            <a href="{{ route('company.login') }}">Login</a>

            @if (Route::has('company/register'))
            <a href="{{ route('company.register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif-->
        </div>
    </div>

    <div id="app">
        <!--<welcome-component />-->
    </div>

</body>

</html>