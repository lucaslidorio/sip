<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCommission extends FormRequest
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
        return [
            'nome' => ['required', 'min:3', 'max:255', "unique:commissions,nome,{$id},id"],
            'objetivo' => ['nullable', 'min:5', 'max:255'],
            'tipo' => ['required'],
        ];
    }
}
