<?php

namespace App\Http\Controllers\Company\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::COMPANIES_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company')->except('logout');
    }

    public function showLoginForm()
    {
        return view('company.auth.login');
    }

    protected function guard()
    {
        //どのテーブルで認証を行うかの設定
        //config/auth.phpに設定がある
        return Auth::guard('company');
    }
}
