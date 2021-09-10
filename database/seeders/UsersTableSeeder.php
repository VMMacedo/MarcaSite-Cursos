<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com.br',
                'password' => Hash::make('123456789'),
                'id_perfil' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Operador',
                'email' => 'operador@operador.com.br',
                'password' => Hash::make('123456789'),
                'id_perfil' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
