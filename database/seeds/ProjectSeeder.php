<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => "Drone",
            'description' => "Lorem ipsum sit amet dolor ZEUBI",
            'status' => "STARTED",
            'drive_link' => "https://example.com",
            'drive_link' => "https://picsum.photos/200",
            'start_date' => now(),
        ]);
    }
}
