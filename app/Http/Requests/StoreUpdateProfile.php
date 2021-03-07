<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProfile extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->segment(3);
        return [
            'nome' => ['required', 'min:3', 'max:255', "unique:profiles,nome,{$id},id"],
            'descricao' => ['nullable', 'min:2', 'max:255'],
        ];
    }
}
