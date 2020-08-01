<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Info;

class InfoController extends Controller
{
    //
    public function index(){

        return \App\Info::orderBy('id', 'desc')->get();
    }

    public function getInfo(Info $info){

        return $info;
    }

    public function createInfo(Request $request)
    { // 
        /*
        $all_tags = [];
        foreach($request->tags as $tag) {
            //var_dump($tag['text']);
            array_push($all_tags, $tag['text']);
        }
        //dd($all_tags);

        //重複したタグを削除
        $unique_tags = array_unique( $all_tags );
        
        var_dump($unique_tags);

        $tags = [];
        if( isset($unique_tags)){
            foreach ($unique_tags as $tag) {
    
                // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
                $record = \App\InfoTag::firstOrCreate([
                    'name' => $tag
                ]);
                array_push($tags, $record);
            };
        }

        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
        */

        // 投稿にタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        $info = Info::create([
            'company_id' => Auth::guard('company')->user()->id,
            'title' => $request->title,
            'text' => $request->text
        ]);

        //$post->tags()->attach($tags_id);

        event(new \App\Events\InfoCreated($info));
    }

    public function deleteInfo(Request $request){
        \App\Info::where('id', $request->id)->delete();
    }
}
