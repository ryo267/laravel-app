<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Favorite;


class FavoriteController extends Controller
{
    //
    public function index(Int $postID, Int $userID)
    {

        $favo_flag = \App\Favorite::where( 'user_id', $userID )->where( 'post_id', $postID )->exists();
        $count = \App\Favorite::where('post_id', $postID )->count();

        //var_dump( $favo_flag );
        //var_dump( $count );

        return [$favo_flag,$count];
    }

    public function addFavo(Request $request)
    {

        \App\Favorite::firstOrCreate([
            'user_id' => $request->userID,
            'post_id' => $request->postID
        ]);

        //var_dump($favorite);

        //event(new \App\Events\FavoriteEvent());

        $count = \App\Post::find($request->postID)->favorites()->count();
        $favo_flag = \App\Favorite::where('user_id',$request->userID)->where('post_id',$request->postID)->exists();

        return [$count,$favo_flag];
        
    }

    public function deleteFavo(Int $postID, Int $userID)
    {
        //var_dump($postID);

        //var_dump(\App\Favorite::where( 'user_id', $userID )->where( 'post_id', $postID )->get());

        \App\Favorite::where( 'user_id', $userID )->where( 'post_id', $postID )->delete();

        //dd(\App\Favorite::where( 'user_id', $user_id )->where( 'post_id', $postID )->get());

        //event(new \App\Events\FavoriteEvent());

        $count = \App\Post::find($postID)->favorites()->count();
        $favo_flag = \App\Favorite::where('user_id',$userID)->where('post_id',$postID)->exists();

        return [$count,$favo_flag];

    }
}
