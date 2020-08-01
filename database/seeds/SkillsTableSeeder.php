<?php

use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $skills = ['HTML','CSS','JavaScript','PHP','Ruby','C','C++','C#','Python'];
        
        for($i=0; $i<count($skills); $i++){
            \App\Skill::create([
                'name'           => $skills[$i],
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
        }
    }
}
