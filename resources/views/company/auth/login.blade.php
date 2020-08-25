@extends('layouts.app_company')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 company-login-form p-5">
            <div class="background"></div>
            <div class="user_icon"><i class="fas fa-user fa-4x"></i></div>
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

                        <div class="form-group row mb-0 p-0 mt-3">
                            <div class="col">
                                <button type="submit" class="btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link px-0 mt-2" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection