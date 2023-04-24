<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDirectorTable extends FormRequest
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
        
        $id  = $this->segment(3);
        
        $rules = [           
            'nome' => ['required', 'min:3', 'max:255', "unique:director_tables,nome,{$id},id"],
            'biennium_legislature_id' => ['required'],
            'atual' => ['required'],
            
            
        ];                
        return $rules;
    }
    public function messages()
    {
        return [     
                  'biennium_legislature_id.required' =>'O campo Biênio é obrigatório',
                  'nome.unique' => 'O nome, informado já esta cadastrado',   
                  'atual.required' =>'O campo Atual é obrigatório'
        ];
    }
}
