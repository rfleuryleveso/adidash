<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => "ADI 1.1",
            'description' => "Groupe de classe théorique 1.1",
            'is_class' => true,
            'rank' => 0,
            'auto_expire' => 'S'
        ]);
        DB::table('groups')->insert([
            'name' => "ADI 1.1 - Délégué",
            'description' => "Délégué ADI1.1",
            'is_class' => false,
            'rank' => 1,
            'auto_expire' => 'S'
        ]);
        DB::table('groups')->insert([
            'name' => "ADI 1.1 - Comité",
            'description' => "Comité ADI1.1",
            'is_class' => false,
            'rank' => 2,
            'auto_expire' => 'S'
        ]);
        DB::table('groups')->insert([
            'name' => "Staff",
            'description' => "Groupe du staff",
            'is_class' => false,
            'rank' => 3
        ]);
        DB::table('groups')->insert([
            'name' => "Administration",
            'description' => "Administrateur du site",
            'is_class' => false,
            'rank' => 4
        ]);
    }
}
