<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert(
            [
                ['id' => 1, 'nome' => 'Operador', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'nome' => 'Administrador', 'created_at' => now(), 'updated_at' => now()],
            ]
        );
    }
}
