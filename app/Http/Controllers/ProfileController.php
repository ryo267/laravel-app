<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Session;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('/home');
    }

    public function store(ProfileRequest $request)
    {
        $file_name = $request->file->getClientOriginalName();

        $user = \App\User::find(Auth::id());

        $user->update([ 
            'profile_image' => '/storage/profile_images/'.Auth::id().'/'.$file_name 
        ]);

        $request->file->storeAs('public/profile_images/'.Auth::id().'/',$file_name);

        //Session::flash('success', '投稿が完了しました');

        return Auth::user();
    }

    public function storeBack(ProfileRequest $request)
    {
        $file_name = $request->file->getClientOriginalName();

        $user = \App\User::find(Auth::id());

        $user->update([ 
            'back_image' => '/storage/profile_images/'.Auth::id().'/'.$file_name 
        ]);

        $request->file->storeAs('public/profile_images/'.Auth::id().'/',$file_name);

        //Session::flash('success', '投稿が完了しました');
        return Auth::user();
    }

    public function storeCompany(ProfileRequest $request)
    {
        $file_name = $request->file->getClientOriginalName();

        $user = Auth::guard('company')->user();

        $user->update([ 
            'profile_image' => '/storage/profile_images/company/'.$user->id.'/'.$file_name 
        ]);

        $request->file->storeAs('public/profile_images/company/'.$user->id.'/',$file_name);

        //Session::flash('success', '投稿が完了しました');

        return $user;
    }

    public function storeBackCompany(ProfileRequest $request)
    {
        $file_name = $request->file->getClientOriginalName();

        $user = Auth::guard('company')->user();

        $user->update([ 
            'back_image' => '/storage/profile_images/company/'.$user->id.'/'.$file_name 
        ]);

        $request->file->storeAs('public/profile_images/company/'.$user->id.'/',$file_name);

        //Session::flash('success', '投稿が完了しました');
        return $user;
    }
}
