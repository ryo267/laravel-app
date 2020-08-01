<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ツイート投稿も各ユーザー毎に1件登録しておきます。
        for ($i = 1; $i <= 10; $i++) {
            \App\Post::create([
                'user_id'    => $i,
                'title'    => 'タイトル'.$i,
                'text'       => 'これはテスト投稿' .$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
