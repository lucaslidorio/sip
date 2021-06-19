<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAttachmentSession extends FormRequest
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
            'type_document_id' => ['required'],
            'descricao' => ['max:255'],
            'anexo' => ['required'],
            'anexo' => ['mimes:pdf', 'max:83900'],
        ];
    }
    public function messages()
    {
        return [     
                  'type_document_id.required' => 'O Campo tipo é obrigatório',  
                  'descricao.max' => 'o texto nao pode conter mais que 255 caracteres', 
                  
        ];
    }
}
