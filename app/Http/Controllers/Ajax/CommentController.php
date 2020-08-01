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

        //echo 'index id ='.$id;

        //$counts = \App\Comment::where('post_id',$id)->count();
        //$comments = \App\Comment::where('post_id',1)->get();
        
        //return [$counts,$comments];

        $counts = Post::find($id)->comments()->count();
        return $counts;

    }

    public function getComments(Int $id){

        //echo 'getComments id ='.$id;
        
        //$comments = \App\Comment::where('post_id',$id)->get();

        //var_dump($comments);

        $comments = Post::find($id)->comments()->get();

        return $comments;
    }

    public function store(Request $request){

        //echo 'getComments id ='.$id;

        //dd($request->all());
        
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
