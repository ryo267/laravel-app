<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ユーザID1が自分を除くツイートに対して1ついいねを付ける
        for ($i = 2; $i <= 10; $i++) {
            \App\Favorite::create([
                'user_id' => $i,
                'post_id' => $i
            ]);
        }
    }
}
