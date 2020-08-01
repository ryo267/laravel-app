<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(FollowingsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
        $this->call(FollowersTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(InfosTableSeeder::class);

        
    }
}
