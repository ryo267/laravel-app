<?php

use Illuminate\Database\Seeder;

class ApplicantsTableSeeder extends Seeder
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
            \App\Applicant::create([
                'company_id' => $i+10,
                'user_id' => $i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
