<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCursos extends FormRequest
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
            'nome' => ['required', 'min:5', 'max:255'],
            'descricao' => ['required', 'min:5', 'max:255'],
            'valor' => ['required'],
            'datainicio' => ['required'],
            'datafim' => ['required'],
            'qtdmaxima' => ['required'],
            'material' => ['required', 'mimes:jpg,bmp,png,ppt,pptx,zip,pdf']
        ];
    }
}
