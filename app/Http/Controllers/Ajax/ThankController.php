<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Thank;

class ThankController extends Controller
{
    //

    public function getThanks(Comment $comment){
        $thank = \App\Thank::where('comment_id',$comment->id)->count();

        return $thank;
    }

    public function giveThanks(Request $request)
    {

        Thank::firstOrCreate([
            'user_id' => $request->userID,
            'comment_id' => $request->commentID
        ]);

        

        $thank = \App\Thank::where('comment_id',$request->commentID)->count();

        return $thank;
        
    }
}
