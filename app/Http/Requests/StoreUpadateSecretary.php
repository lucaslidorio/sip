<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpadateSecretary extends FormRequest
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
        $id = $this->segment(3);
        return [
            'nome' => ['required', 'min:3', 'max:255', "unique:secretaries,nome,{$id},id"],
            'sigla' => ['nullable', 'min:2', 'max:255' ,"unique:secretaries,sigla,{$id},id"],
            'nome_responsavel' => ['nullable', 'min:3', 'max:255' ],
            'telefone' => ['nullable','min:4','numeric'],
            'celular' => ['nullable','min:8','numeric'],
            'endereco' => ['nullable', 'min:5', 'max:255' ],
            'email' => ['nullable', 'email' ],
        ];
    }
}
