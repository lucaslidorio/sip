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
            'sigla' => ['nullable', 'min:2', 'max:10' ,"unique:secretaries,sigla,{$id},id"],
            'nome_responsavel' => ['nullable', 'min:3', 'max:255' ],
            'situacao' => ['required', 'boolean'],
            'telefone' => ['nullable','min:4'],
            'celular' => ['nullable','min:8'],
            'endereco' => ['nullable', 'min:5', 'max:255' ],
            'email' => ['nullable', 'email' ],
            'img_secretario' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sobre_secretario' => 'nullable|string',
            'slogan' => 'nullable|string|max:45',
            'icone' => 'nullable|string|max:50',
            'sobre' => 'nullable|string',
            // Formato #RRGGBB (7 chars, incluindo #)
            'cor_destaque' => ['nullable', 'string', 'size:7', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ];
    }
}
