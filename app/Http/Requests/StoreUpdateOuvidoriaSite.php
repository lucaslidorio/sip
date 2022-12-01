<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOuvidoriaSite extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
       $rules = [           
            'tipo_id' => ['required'],
            'anonimo' => ['required', 'boolean'],
            'sigiloso' => ['required', 'boolean'],
            'nome' => ['nullable','min:3', 'max:255', 'string'],
            'cpf' => ['nullable', 'min:2', 'max:14'],
            'email' => ['nullable', 'min:3', 'max:255', 'email'],
            'telefone' => ['nullable', 'min:3', 'max:15'],
            'celular' => ['nullable', 'min:3', 'max:15'],
            'endereco' => ['nullable', 'min:3', 'max:255'],
            'numero_endereco' => ['nullable', 'max:6'],
            'bairro' => ['nullable', 'min:3', 'max:255'],
            'municipio' => ['nullable', 'min:3', 'max:100'],
            'uf' => ['nullable', 'max:2'],
            'cep' => ['nullable', 'max:10'],
            'complemento' => ['nullable', 'max:255'],
            'genero' => ['nullable', 'numeric'],
            'idade' => ['nullable', 'numeric'],
            'quant_filhos' => ['nullable', 'numeric'],
            'ocupacao' => ['nullable',  'numeric'],
            'manifestacao' => [ 'required', 'min:10', 'max:2000'],
           
        ];
        return $rules;
    }
}
