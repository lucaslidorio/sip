<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCommissonMembers extends FormRequest
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
        return [
            'councilor_id' => ['required'],
            'function_id' => ['required'],
        ];

        
    }
    public function messages()
    {
        return [     
                  
                  'councilor_id.required' =>'O campo Membro é obrigatório',
                  'function_id.required' =>'O campo Função é obrigatório',
                  
        ];
    }
}
