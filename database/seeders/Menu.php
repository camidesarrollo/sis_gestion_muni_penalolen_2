<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('menus')->insert([
            'name' => 'Dashboard',
            'path' => '/dashboard',
            'icon' => 'fas fa-home',
            'padre' => '0',
            'orden' => '1',
            'descripcion' => '',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menus')->insert([
            'name' => 'Mantenedores',
            'path' => '/mantenedores',
            'icon' => '',
            'padre' => '0',
            'orden' => '2',
            'descripcion' => '',
            'vigencia_id' => 1,
        ]);

        DB::table('menus')->insert([
            'name' => 'Mantenedor menu',
            'path' => '/mantenedor_menu',
            'icon' => 'bi bi-menu-up',
            'descripcion' => '',
            'orden' => '3',
            'padre' => '2',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Mantenedor usuario',
            'path' => '/mantenedor_usuario',
            'icon' => 'bi bi-people-fill',
            'descripcion' => '',
            'padre' => '2',
            'orden' => '4',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Mantenedor perfil',
            'path' => '/mantenedor_perfil',
            'icon' => 'bi bi-person-badge',
            'descripcion' => '',
            'padre' => '2',
            'orden' => '5',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Reportes',
            'path' => '/reportes',
            'icon' => '',
            'padre' => '0',
            'descripcion' => '',
            'orden' => '6',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Dipres',
            'path' => '/dipres',
            'icon' => 'fa fa-money-bill ',
            'descripcion' => '',
            'padre' => '6',
            'orden' => '7',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Horas Extras',
            'path' => '/horas_extras',
            'icon' => 'fa fa-business-time',
            'descripcion' => '',
            'padre' => '6',
            'orden' => '8',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('menus')->insert([
            'name' => 'Transparencia Honoraria',
            'path' => '/transparencia_honoria',
            'icon' => 'fa fa-award',
            'descripcion' => '',
            'padre' => '6',
            'orden' => '9',
            'vigencia_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);



    }


    
}
