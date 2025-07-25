<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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

        $rules =  [
            'name' => ['required','min:5','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$id},id"],
            'password' =>['required','min:8','confirmed'],
            'password_confirmation' =>['required','same:password']
        ];
         if($this->method() == 'PUT'){
             $rules['password'] = ['nullable', 'min:8','confirmed'];
             $rules['password_confirmation'] = ['nullable', 'same:password'];
         }
        return $rules;
    }
}
