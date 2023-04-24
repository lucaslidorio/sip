<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePost extends FormRequest
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
            'titulo' => ['required', 'min:5', 'max:255', "unique:posts,titulo,{$id},id"],
            'secretary_id' => ['required'],
            'data_expiracao' => ['nullable','date_format:Y-m-d','after_or_equal:today'],
            'categories' =>['required_without_all'],
            'img_destaque' => ['required','image','max:1024' ],
            'destaque' => ['required'],
            'conteudo' => ['required', 'min:10'],
            //'img_galeria.*' => ['image|max:9000'] 

            //'tags' => 'array|size:5';
          
        ];

        if($this->method() =='PUT'){
            $rules['img_destaque'] = ['nullable','image','max:1024' ];  
            $rules['conteudo'] = ['required', 'min:10'];        
        }
        return  $rules;
        
    }
    public function messages()
    {
        return [
            'img_destaque.required' => 'Selecione uma imagem',
            'data_expiracao.after_or_equal' => 'O campo data de expiração deve ser igual ou superior a data de hoje',
            'img_destaque.max' => 'A imagem não pode ser superior a 2 MB',
            'secretary_id.required' => 'Campo obrigatório',
            'categories.required_without_all' => 'Obrigatório selecionar pelo menos uma categoria'
            
        ];
    }
}
