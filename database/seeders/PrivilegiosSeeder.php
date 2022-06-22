<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PrivilegiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('privilegios')->insert([
            'escribir' => 1,
            'leer' => 1,
            'eliminar' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('privilegios')->insert([
            'escribir' => 1,
            'leer' => 0,
            'eliminar' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('privilegios')->insert([
            'escribir' => 1,
            'leer' => 1,
            'eliminar' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
