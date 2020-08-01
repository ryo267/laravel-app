<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ['HTML','CSS','JavaScript','PHP','Ruby','C','C++','C#','Python'];
        
        for($i=0; $i<count($tags); $i++){
            \App\Tag::create([
                'name'           => $tags[$i],
                'created_at'     => now(),
                'updated_at'     => now()
            ]);
        }
    }
}
