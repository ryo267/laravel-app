<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $count = \App\User::all()->count();
        $count = $count + \App\Company::all()->count() +1;

        for($i=0; $i<10; $i++){
            \App\Company::create([
                'id' => $count,
                'screen_name'    => 'test_company' .$i,
                'name'           => 'company' .$i,
                'profile_text'  => 'profile'.$i,
                'profile_image'  => '/sample/user.png',
                'back_image'  => '/sample/noimage.jpg',
                'email'          => 'company' .$i .'@test.com',
                'password'       => Hash::make('12345678'),
                'remember_token' => str_random(10),
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
            $count++;
        }
    }
}
