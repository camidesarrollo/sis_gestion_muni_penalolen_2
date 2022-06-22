<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Camila Paz',
            'ap_paterno' => 'Zaragoza',
            'ap_materno' => 'Villaseca',
            'email' => 'admin@softui.com',
            'run' => '19566808',
            'phone' => '+56951108675',
            'vigencia_id' => 1,
            'dv' => '6',
            'password' => Hash::make('secret'),
            'rol_id' => 1,

            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
