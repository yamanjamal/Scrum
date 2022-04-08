<?php

namespace Database\Seeders;

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
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            RequirmentSeeder::class,
            SrsSeeder::class,
            TaskSeeder::class,
            CommentSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
