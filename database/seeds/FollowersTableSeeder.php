<?php

use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ユーザID1を各ユーザがフォローして置く
        for ($i = 2; $i <= 10; $i++) {
            \App\Follower::create([
                'following_id' => $i,
                'followed_id' => 1
            ]);
        }
    }
}
