<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cursos')->insert([
            [
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Administração',
                'descricao' => 'Administração',
                'valor' => '1000.50',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '30',
                'material' => 'material.txt',
            ],
            [
                'id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Informática',
                'descricao' => 'Programação WEB',
                'valor' => '2300.00',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '20',
                'material' => 'material.txt',
            ],
            [
                'id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Programação Web',
                'descricao' => 'Programação Laravel',
                'valor' => '4500.50',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '25',
                'material' => 'material.txt',
            ],
            [
                'id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Callcenter',
                'descricao' => 'Curso destinado ao Callcenter',
                'valor' => '890.00',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '10',
                'material' => 'material.txt',
            ],
            [
                'id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Contabilidade',
                'descricao' => 'Contabilidade',
                'valor' => '3225.00',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '18',
                'material' => 'material.txt',
            ],
            [
                'id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'Aplicativos Mobile',
                'descricao' => 'Programação para aplicativos',
                'valor' => '5550.00',
                'datainicio' => '2021-06-01',
                'datafim' => '2021-12-01',
                'qtdmaxima' => '20',
                'material' => 'material.txt',
            ],

        ]);
    }
}
