<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePronunciamento extends FormRequest
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
            'councilor_id' => 'required|exists:councilors,id',
            'session_id'   => 'required|exists:sessions,id',
            'discurso'     => 'nullable|string',
            'link_video'   => 'nullable|url|max:100',
        ];
    }
    
    public function messages(): array
    {
        return [
            'councilor_id.required' => 'Selecione um vereador.',
            'councilor_id.exists'   => 'O vereador selecionado não existe.',
            'session_id.required'   => 'Selecione uma sessão.',
            'session_id.exists'     => 'A sessão selecionada não existe.',
            'link_video.url'        => 'O link do vídeo deve ser uma URL válida.',
        ];
    }
}
