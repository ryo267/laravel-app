<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('/home');
    }

    
    public function store(ProfileRequest $request)
    {

        $file_name = $request->file('file');

        $user = Auth::user();

        $path = Storage::disk('s3')->putFile('profile_images/user/'.Auth::id(), $file_name, 'public');

        // アップロードした画像のフルパスを取得
        $s3_url = Storage::disk('s3')->url($path);

        $user->update([
            'profile_image' => $s3_url
        ]);

        return $user;

    }


    public function storeBack(ProfileRequest $request)
    {
        $file_name = $request->file('file');

        $user = Auth::user();

        $path = Storage::disk('s3')->putFile('profile_images/user/'.Auth::id(), $file_name, 'public');

        // アップロードした画像のフルパスを取得
        $s3_url = Storage::disk('s3')->url($path);

        $user->update([
            'back_image' => $s3_url
        ]);

        return $user;
    }


    public function storeCompany(ProfileRequest $request)
    {
        $file_name = $request->file('file');

        $user = Auth::guard('company')->user();

        $path = Storage::disk('s3')->putFile('profile_images/company/'.$user->id, $file_name, 'public');

        // アップロードした画像のフルパスを取得
        $s3_url = Storage::disk('s3')->url($path);

        $user->update([
            'profile_image' => $s3_url
        ]);

        return $user;
    }


    public function storeBackCompany(ProfileRequest $request)
    {
        $file_name = $request->file('file');

        $user = Auth::guard('company')->user();

        $path = Storage::disk('s3')->putFile('profile_images/company/'.$user->id, $file_name, 'public');

        // アップロードした画像のフルパスを取得
        $s3_url = Storage::disk('s3')->url($path);

        $user->update([
            'back_image' => $s3_urls
        ]);

        return $user;
    }

}
