<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('rols')->insert([
            'name' => 'Administrador',
            'vigencia_id' => 1,
            'privilegios_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('rols')->insert([
            'name' => 'Usuario',
            'vigencia_id' => 1,
            'privilegios_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
