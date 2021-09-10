<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class InscritosSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inscricao')->insert([
            [
                'id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'CARLOS REIS BARROS',
                'email' => 'francisco@francisco.com.br',
                'cpf' => '48984679038',
                'cep' => '78788388',
                'rua' => 'Pará',
                'bairro' => 'Santo Antônio',
                'numero' => '6808',
                'complemento' => 'Quadra 5',
                'cidade' => 'Boa Vista',
                'uf' => 'RR',
                'empresa' => 'RR Transportes',
                'telefone' => '95727796943',
                'celular' => '95944721806',
                'categoria' => 'Estudante',
                'status' => '0',
                'senha' => '123456789',
                'cursoid' => 1,
                
            ],
            [
                'id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'LUCAS BATISTA RAMOS',
                'email' => 'joao@joao.com.br',
                'cpf' => '11302475037',
                'cep' => '78788388',
                'rua' => 'São Sebastião',
                'bairro' => 'Boa Vista',
                'numero' => '4878',
                'complemento' => '',
                'cidade' => 'Cariacica',
                'uf' => 'ES',
                'empresa' => 'ES Roupas',
                'telefone' => '',
                'celular' => '27973592048',
                'categoria' => 'Estudante',
                'status' => '1',
                'senha' => '123456789',
                'cursoid' => 1,
            ],
            [
                'id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'PEDRO NUNES MOREIRA',
                'email' => 'joao@joao.com.br',
                'cpf' => '63133856324',
                'cep' => '78788388',
                'rua' => 'São Sebastião',
                'bairro' => 'Boa Vista',
                'numero' => '4878',
                'complemento' => '',
                'cidade' => 'Cariacica',
                'uf' => 'PR',
                'empresa' => 'ES Roupas',
                'telefone' => '',
                'celular' => '27973592048',
                'categoria' => 'Estudante',
                'status' => '2',
                'senha' => '123456789',
                'cursoid' => 2,
            ],
            [
                'id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'PEDRO NUNES MOREIRA',
                'email' => 'joao@joao.com.br',
                'cpf' => '63133856324',
                'cep' => '78788388',
                'rua' => 'São Sebastião',
                'bairro' => 'Boa Vista',
                'numero' => '4878',
                'complemento' => '',
                'cidade' => 'Cariacica',
                'uf' => 'PR',
                'empresa' => 'ES Roupas',
                'telefone' => '',
                'celular' => '27973592048',
                'categoria' => 'Estudante',
                'status' => '2',
                'senha' => '123456789',
                'cursoid' => 3,
            ],
            [
                'id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
                'nome' => 'PEDRO NUNES MOREIRA',
                'email' => 'joao@joao.com.br',
                'cpf' => '63133856324',
                'cep' => '78788388',
                'rua' => 'São Sebastião',
                'bairro' => 'Boa Vista',
                'numero' => '4878',
                'complemento' => '',
                'cidade' => 'Cariacica',
                'uf' => 'PR',
                'empresa' => 'ES Roupas',
                'telefone' => '',
                'celular' => '27973592048',
                'categoria' => 'Estudante',
                'status' => '1',
                'senha' => '123456789',
                'cursoid' => 3,
            ]
        ]);
    }
}
