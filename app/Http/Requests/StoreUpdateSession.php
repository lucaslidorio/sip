<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSession extends FormRequest
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
            'nome' => ['required', 'min:2', 'max:255'],
            'data' => ['required', 'date'],
            'hora' => ['required'],
            'type_session_id' => ['required'],
            'legislature_id' => ['required'],
            'legislature_section_id' => ['required'],
            'period_id' => ['required'],
           
                     
          
        ];

        if($this->method() =='PUT'){
              
            $rules['nome'] = ['required', 'min:2'];        
        }
        return  $rules;
    }
    public function messages()
    {
        return [
            'type_session_id.required' => 'O campo tipo é obrigatório',
            'legislature_id.required' => 'O campo legislatura é obrigatório',
            'legislature_section_id.required' => 'O campo sessão é obrigatório',
            'period_id.required' => 'O campo período é obrigatório',
            
            

             
        ];
    }
}
