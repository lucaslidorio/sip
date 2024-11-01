<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpadateLegislation extends FormRequest
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
           
            'type_legislation_id' => ['required'],
            'type_document_id' => ['required'], 
            'caput' =>['max:500'],
            'data' => ['required'],
            'anexo.*' => ['required','mimes:pdf', 'max:2048'],                     
          
        ];

        if($this->method() =='PUT'){
              
         $rules['type_document_id'] = ['nullable'];
                   
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'type_legislation_id.required' => 'O campo tipo é obrigatório',           
            'anexo.max' => 'A anexo não pode ser superior a 2 MB',
            'type_document_id.required' => 'Campo tipo de anexo é obrigatório',
           
        ];
    }
}
