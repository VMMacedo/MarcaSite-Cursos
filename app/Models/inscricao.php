<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inscricao extends Model
{
    use HasFactory;

    protected $table = 'inscricao';
    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'rua',
        'cidade',
        'uf',
        'cep',
        'numero',
        'complemento',
        'bairro',
        'empresa',
        'telefone',
        'celular',
        'categoria',
        'senha',
        'cursoid'
    ];
}
