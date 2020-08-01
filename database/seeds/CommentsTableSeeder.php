<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ユーザID1のユーザが各ユーザに1つコメントしておきます。
        for ($i = 1; $i <= 10; $i++) {
            \App\Comment::create([
                'text' => 'これはテストコメント' .$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
