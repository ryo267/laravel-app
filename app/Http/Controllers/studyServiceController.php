<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class studyServiceController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	//
	/*public function index()
	{
		$infos = \App\Info::orderBy('created_at', 'desc')->take(5)->get();
        $all_users = \App\User::all();
        $i = \App\Post::findOrFail(1);
        $i = \App\Post::find(2);

        return view('studyService/index',compact('infos'),compact('all_users'),compact('i'));
    }*/
    
	public function edit($id)
	{
		//DBからIDが一致したユーザーの情報を取得
		$user = User::findOrFail($id);

		//取得した値をeditに渡す
		return view('studyService/edit',compact('user'));
	}

	public function follow($id)
    {
        $follower = Auth::user();

        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow($id)
    {
        $follower = Auth::user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }
	
}
