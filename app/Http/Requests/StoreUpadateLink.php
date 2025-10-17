<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpadateLink extends FormRequest
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
        $id  = $this->id ?? '';
        
        $rules = [           
            'nome' => ['required', 'min:2','max:45', "unique:links,nome,{$id},id"],
            'descricao' => ['nullable', 'string', 'max:255'],
            'url' => ['required', 'min:1', 'max:255'],
            'target' =>['required','boolean'], 
            'tipo' =>['required'],
            'ordem' =>['numeric'],
            'posicao' =>['required'],

            //'icone' => ['required','mimes:svg', 'max:83900'],
            //'icone' =>['nullable','image','max:300'],
            
        ]; 
        if($this->method() =='PUT'){
            //$rules['icone'] = ['nullable','image','max:300' ]; 
                    
        }        
        return $rules;
    }
    public function messages()
    {
        return [        
                   'target.required' => 'Campo obrigatório'                   
        ];
    }
}
