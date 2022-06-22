<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolsMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::connection('sqlsrv')->table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 7,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' =>8,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols_menu')->insert([
            'id_role' => 1,
            'id_menu' => 9,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
