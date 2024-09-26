<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSubTipoMateria extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id  = $this->segment(3);
        
        return [
                      
            'nome' => ['required', 'min:3', 'max:255', "unique:sub_tipo_materias,nome,{$id},id"],
            'tipo_materia_id' => ['required', 'numeric'],
            'situacao' => ['required','numeric'],            
        ];
    }
    public function messages(){
        return [
            'tipo_materia_id.required' => 'O campo tipo de matéria é obrigatório',   
        ];

    }
}
