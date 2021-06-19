<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProposition extends FormRequest
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
        $rules = [          
            'proceeding_situation_id' => ['required'],
            'type_proposition_id' => ['required'],
            'type_document_id' => ['required'],
           // 'councilor_id' => ['required', 'array'],            
            'anexo.*' => ['required','mimes:pdf', 'max:83900'],
                     
          
        ];

        if($this->method() =='PUT'){
              
         $rules['type_document_id'] = ['nullable'];
                   
        }
        return  $rules;
    }
    
    public function messages()
    {
        return [
            'proceeding_situation_id.required' => 'O campo situação é obrigatório',
            'type_proposition_id.required' => 'O campo tipo é obrigatório',
            'type_document_id.required' => 'O campo tipo de documento é obrigatório',
            'councilor_id.*.required' => 'O campo autor é obrigatório',
            //'anexo.max' => 'O arquivo não pode ser superior que 2 MB',
            'anexo.*.mimes' => 'tipo pdf'          

             
        ];
    }
    
}
