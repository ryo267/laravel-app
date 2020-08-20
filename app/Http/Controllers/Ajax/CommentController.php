<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\Post;
class CommentController extends Controller
{
    //
    public function index(Int $id){

        $counts = Post::find($id)->comments()->count();
        return $counts;

    }

    public function getComments(Int $id){

        $comments = Post::find($id)->comments()->get();

        return $comments;
    }

    public function getUser(Int $id){

        $user = Comment::find($id)->user()->get();

        return $user;
    }

    public function store(Request $request){
        
        $user = [];
        if ( \App\User::where('id',$request->userID)->exists() ){
            $user = \App\User::find($request->userID);
        }else {
            $user = \App\Company::find($request->userID);
        }
        
        $comment = Comment::create([
            'text' => $request->message,
        ]);

        $user->comments()->attach($comment->id);
        $comment->post()->attach($request->postID);
        
        event(new \App\Events\CommentEvent($comment));

    }

}
