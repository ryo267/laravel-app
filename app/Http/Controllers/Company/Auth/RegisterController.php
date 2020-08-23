<?php

namespace App\Http\Controllers\Company\Auth;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::COMPANIES_HOME;
    //protected $redirectTo = RouteServiceProvider::COMPANIES_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validate = Validator::make($data, [
            'screen_name' => ['required', 'string', 'max:255', 'unique:companies'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        //dd($validate->errors()->all());

        return $validate;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $count = \App\User::all()->count();
        $count = $count + \App\Company::all()->count() +1;
        
        $company = \App\Company::create([
            'id' => $count,
            'screen_name' => $data['screen_name'],
            'name' => $data['name'],
            'profile_image' => '/sample/user.png',
            'back_image' => '/sample/noimage.jpg',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $company;
    }

    public function showRegistrationForm()
    {
        return view('company.auth.register');
    }

    protected function guard()
    {
        return Auth::guard('company');
    }
}
