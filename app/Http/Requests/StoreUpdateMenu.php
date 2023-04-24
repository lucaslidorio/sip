<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMenu extends FormRequest
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
            'nome' => ['required', 'min:2','max:255', "unique:menus,nome,{$id},id"],           
            'target' =>['required','boolean'], 
            
            
        ]; 
        if($this->method() =='PUT'){
            $rules['img'] = ['nullable','image','max:300' ]; 
                    
        }        
        return $rules;

    }
    public function messages()
    {
        return [        
                   'target.required' => 'Campo obrigatório',
                   'target.boolean' => 'O valor deve ser do tipo boolean'
        ];
    }
}
