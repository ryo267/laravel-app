<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    //
    public function index(Request $request)
    {

        //Posts-Component
        if ($request->tag === 'all_posts') {
            return \App\Post::orderBy('id', 'desc')->get(['id', 'user_id']);
        } else {

            $post1 = \App\Post::where('title', 'like', '%'.$request->tag.'%')->get();

            if ( Tag::where('name', $request->tag)->exists() ) {
                $tag = Tag::where('name', $request->tag)->first();
                $post = $tag->post()->get();
                $posts = $post1->concat($post)->unique()->sortByDesc('id')->values()->all();
                return $posts;
            }

            return $post1;
        }
    }

    public function getUserPosts(Int $id)
    {

        //Posts-Component
        $user = \App\User::find($id);
        return $user->posts()->orderBy('id', 'desc')->get(['id', 'user_id']);
    }

    public function reload()
    {
        //Posts-Component
        event(new \App\Events\PostReload());
    }

    public function getPost(Post $post)
    {
        //Post-Component
        return $post;
    }

    public function create(Request $request)
    { // 

        $all_tags = [];
        foreach ($request->tags as $tag) {
            //var_dump($tag['text']);
            array_push($all_tags, $tag['text']);
        }
        //dd($all_tags);

        //重複したタグを削除
        $unique_tags = array_unique($all_tags);

        var_dump($unique_tags);

        $tags = [];
        if (isset($unique_tags)) {
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

        // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'text' => $request->text
        ]);

        $post->tags()->attach($tags_id);

        event(new \App\Events\PostCreated($post));
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return $post;
    }

    public function deletePost(Request $request)
    { // 

        \App\Post::where('id', $request->id)->delete();

        event(new \App\Events\PostDeleted());
    }
}
