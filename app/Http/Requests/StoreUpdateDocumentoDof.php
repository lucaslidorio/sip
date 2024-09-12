<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateDocumentoDof extends FormRequest
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
        return [
            
            'tipo_materia_id' => 'required|exists:tipo_materias,id', // Verifica se o tipo de matéria existe
            'sub_tipo_materia_id' => 'required|exists:sub_tipo_materias,id', // Verifica se o subtipo existe
            'titulo' => 'required|string|max:255', // Título obrigatório, máximo 255 caracteres
            'conteudo' => 'nullable|string', // O conteúdo pode ser nulo, mas deve ser uma string se presente
            'data_publicacao' => 'nullable|date', // Data opcional, deve ser válida e até a data atual
        ];
    }
    public function messages(): array
    {
        return [
            
            'tipo_materia_id.required' => 'O campo tipo de matéria é obrigatório.',
            'tipo_materia_id.exists' => 'O tipo de matéria selecionado não é válido.',
            'sub_tipo_materia_id.required' => 'O campo subtipo de matéria é obrigatório.',
            'sub_tipo_materia_id.exists' => 'O subtipo de matéria selecionado não é válido.',
            'titulo.required' => 'O título é obrigatório.',
            'titulo.max' => 'O título não pode exceder 255 caracteres.',
            'conteudo.string' => 'O conteúdo deve ser um texto válido.',
            'data_publicacao.date' => 'A data de publicação deve ser uma data válida.',
           
        ];
    }
}
