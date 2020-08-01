<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\Post;

class TagController extends Controller
{
    //
    public function index() {
        return Tag::all();
    }

    public function getTag(Request $request) {

        $post = \App\Post::find($request->id);

        /*
        $tags = $post->tags;

        $tags_name =[];

        foreach($tags as $tag){
            array_push($tags_name,$tag['name']);
        }
        $tag_string = implode(",", $tags_name);
        
        $tag_string  = $tag_string;

        return $tag_string;
        */
        return $post->tags()->get();

    }

    public function update(Request $request ) {

        $post = Post::find($request->id);

        var_dump($request->all());
        echo "post =".$post;
        echo "tags = ".$request->tags;

        //重複したタグを削除
        $unique_tags = array_unique( explode(",",$request->tags) );
        
        var_dump($unique_tags);

        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        if(isset($unique_tags)){
            foreach ($unique_tags as $tag) {

                // firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
                $record = \App\Tag::firstOrCreate([
                    'name' => $tag
                ]);
                array_push($tags, $record);
            };
        }
        

        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };

        //一度関連登録したタグをすべて削除して再度登録
        $post->tags()->detach();
        $post->tags()->attach($tags_id);

    }


}
