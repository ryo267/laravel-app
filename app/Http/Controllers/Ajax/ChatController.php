<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    //
    public function index() {// 新着順にメッセージ一覧を取得

        $chat = \App\Message::orderBy('id', 'desc')->get();

        return [$chat,Auth::id()];
    
    }
    
    public function create(Request $request) { // メッセージを登録
    
        $user = [];
        if ( \App\User::where('id',$request->userID)->exists() ){
            $user = \App\User::find($request->userID);
        }else {
            $user = \App\Company::find($request->userID);
        }
        
        $message = \App\Message::create([
            'user_id' => $user->id,
            'user_name' => $user->screen_name,
            'body' => $request->message
        ]);
        event(new \App\Events\MessageCreated($message));
    
    }
}
