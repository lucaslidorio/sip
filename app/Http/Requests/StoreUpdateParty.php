<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateParty extends FormRequest
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
            'nome' => ['required', 'min:3', 'max:255', "unique:parties,nome,{$id},id"],
            'sigla' => ['required', 'min:2', 'max:10',"unique:parties,sigla,{$id},id"],
            'img' =>['nullable','image','max:300'], 
            
        ]; 
        if($this->method() =='PUT'){
            $rules['img'] = ['nullable','image','max:300' ]; 
                    
        }        
        return $rules;
        
    }
    public function messages()
    {
        return [        
                   'img.max' => 'A imagem não pode ser superior a 300kb',
        ];
    }
}
