<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInscrito extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'cpf' => ['required', 'max:13'],
            'cep' => ['required', 'max:8'],
            'rua' => ['required', 'max:200'],
            'bairro' => ['required', 'max:200'],
            'cidade' => ['required', 'max:200'],
            'uf' => ['required', 'min:2', 'max:2'],
            'numero' => ['required', 'min:1', 'max:6'],
            'empresa' => ['required', 'max:100'],
            'telefone' => ['max:12'],
            'celular' => ['required', 'max:12'],
            'categoria' => ['required', 'max:20'],
            'senha' => ['required', 'min:8', 'max:30'],
        ];
    }
}
