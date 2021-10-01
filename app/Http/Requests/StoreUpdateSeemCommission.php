<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSeemCommission extends FormRequest
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
           
            'commission_id' => ['required'],
            'proposition_id' => ['required'],
            'data' => ['required'],
            'type_document_id' => ['required'],
            'autoria' =>['required','max:255'], 
            'assunto' =>['required', 'max:255'],            
            'anexo.*' => ['required','mimes:pdf', 'max:2048'],                   
          
        ];

        if($this->method() =='PUT'){
              
         $rules['type_document_id'] = ['nullable'];
         $rules['anexo.*'] = ['nullable'];
                   
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'commission_id.required' => 'O campo comissão é obrigatório',
            'proposition_id.required' => 'O campo propositura é obrigatório',
            'type_document_id.required' => 'O campo tipo de documento é obrigatório',
              
        ];
    }
}
