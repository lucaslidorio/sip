<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePopups extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id  = $this->segment(3);
        
        $rules = [           
            'nome' => 'required|string|max:255',
            'img' => $this->isMethod('post') ? 'required|image' : 'nullable|image',
            'url' => 'nullable|url',
            'ativo' => 'required|boolean',
            'data_expiracao' => 'nullable|date',
            
        ]; 
        if($this->method() =='PUT'){
            $rules['img'] = ['nullable','image','max:300' ]; 
                    
        }        
        return $rules;
    }
}
