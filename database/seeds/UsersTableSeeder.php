<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*$table->string('email')->unique();
          $table->string('password');
        */
        for($i=0; $i<10; $i++){
            \App\User::create([
                'id' => $i+1,
                'screen_name'    => 'test_user' .$i,
                'name'           => 'TEST' .$i,
                'profile_text'  => 'profile'.$i,
                'profile_image'  => '/sample/user.png',
                'back_image'  => '/sample/noimage.jpg',
                'email'          => 'test' .$i .'@test.com',
                'password'       => Hash::make('12345678'),
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
        }
    }
}
