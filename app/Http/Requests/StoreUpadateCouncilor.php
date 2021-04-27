<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpadateCouncilor extends FormRequest
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
        $id  = $this->segment(4);
        
        $rules = [           
            'nome' => ['required', 'min:3', 'max:255', "unique:councilors,nome,{$id},id"],
            'cpf' => ['nullable', 'min:2', 'max:14',"unique:councilors,cpf,{$id},id"],
            'estado_civil' => ['required', 'min:2', 'max:20'],
            'party_id' => ['required'],
            'img' =>['nullable','image','max:500'],
            'atual' => ['required'],
            
        ]; 
        if($this->method() =='PUT'){
            $rules['img'] = ['nullable','image','max:300' ]; 
                    
        }        
        return $rules;
    }
    public function messages()
    {
        return [     
                  'nome.unique' => 'O nome, informado já esta cadastrado',   
                  'cpf.unique' => 'O CPF, informado já esta cadastrado',
                  'img.max' => 'A imagem não pode ser superior a 500kb',
                  'img.image' => 'O arquivo não é uma imagem válida',
                  'estado_civil.required' =>'O campo Estado Civil é obrigatório',
                  'estado_civil.max' =>'Nome muito longo, máximo de 20 caracteres',
                  'party_id.required' =>'O campo Partido é obrigatório'
        ];
    }
}
