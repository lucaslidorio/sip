<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->segment(3);
        $rules = [          
           
            'titulo' => ['required', 'min:2', 'max:255', "unique:pages,titulo,{$id},id"],                       
            'anexo.*' => ['required','mimes:pdf', 'max:2048'],                     
          
        ];
       
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
