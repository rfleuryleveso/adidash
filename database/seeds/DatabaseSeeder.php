<?php

use Illuminate\Database\Seeder;

use Database\Seeders\GroupSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\TaskSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([GroupSeeder::class, UserSeeder::class, ProjectSeeder::class, TaskSeeder::class]);
    }
}
