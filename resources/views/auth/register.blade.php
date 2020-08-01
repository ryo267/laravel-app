@extends('layouts.app')

@section('content')
<div class="container">
    @if ( $errors->any() )
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8 register-form p-5">
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
    </div>
</div>
@endsection