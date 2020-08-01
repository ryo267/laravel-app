<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $infos = \App\Info::orderBy('id', 'desc')->take(5)->get();
        $all_users = \App\User::whereNotIn('id', [ Auth::id() ] )->get();
        $posts = \App\Post::where('user_id', Auth::id() )->orderBy('id', 'DESC')->get();
        $all_posts = \App\Post::orderBy('id', 'DESC')->get();
        $follow = \App\Follower::where( 'following_id', Auth::id() )->get();
        $follower = \App\Follower::where('followed_id', Auth::id() )->get();
        $tags = \App\tag::all();

        return view('studyService/index',compact('infos','posts','all_posts','all_users','follow','follower','tags') );
    }
}
