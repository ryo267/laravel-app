<?php

use Illuminate\Database\Seeder;

class ScoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            \App\Scout::create([
                'company_id' => $i+10,
                'user_id' => $i,
                'text'       => 'これはスカウトテキスト' .$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
