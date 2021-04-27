<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMinuteController extends FormRequest
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
        $rules = [            
            'nome' => ['required', 'min:5', 'max:255', "unique:minutes,nome,{$id},id"],
            'type_minute_id' => ['required'],
            'legislature_id' => ['required'],
            'legislature_section_id' => ['required'],
            'legislative_period_id' => ['required'],
            'anexo.*' => ['mimes:pdf', 'max:83900'],
                     
          
        ];

        if($this->method() =='PUT'){
              
            $rules['nome'] = ['required', 'min:5'];        
        }
        return  $rules;
    }
    
    public function messages()
    {
        return [
            'type_minute_id.required' => 'O campo tipo é obrigatório',
            'legislature_id.required' => 'O campo legislatura é obrigatório',
            'legislature_section_id.required' => 'O campo sessão é obrigatório',
            'legislative_period_id.required' => 'O campo período é obrigatório',
            //'anexo.max' => 'O arquivo não pode ser superior que 2 MB',
            'anexo.*.mimes' => 'tipo pdf'
            

             
        ];
    }
}
