<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VigenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('vigencia')->insert([
            'name' => 'Vigente',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('vigencia')->insert([
            'name' => 'No vigente',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
