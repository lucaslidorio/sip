<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProcessoCompras extends FormRequest
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

        $rules = [
           
            'numero' => ['required'],
            'modalidade_id' => ['required'],
            'proceeding_situation_id' => ['required'],
            'criterio_julgamento_id' => ['required'],
            'data_validade' => 'required|date', // Confirme que esta validação existe
            'destaque' => ['numeric'],
            'objeto' => ['required', 'min:10', 'max:5000'],
            'descricao' => ['nullable', 'min:10', 'max:5000'],         
        
        ];
        
        return $rules;
    }

    public function messages()
    {
        return [
            'modalidade_id.required' => 'Selecione uma modalidade',
            'proceeding_situation_id.required' => 'Selecione uma situcação',
            'criterio_julgamento_id.required' => 'Selecione um critério de julgamento',
            'data_validade.required' => 'A Data é obrigatório',
            'objeto.required' => 'A Objeto é obrigatório',
            'objeto.max' => 'O campo deve ter mais que 10 caracteres',
                        
          
        ];
    }
}
