<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateMenu extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ajuste se usa policies
    }

    /**
     * Normaliza campos antes da validação (checkboxes).
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'ativo'           => $this->boolean('ativo'),
            'target'          => $this->boolean('target'),
            'pagina_interna'  => $this->boolean('pagina_interna'),
        ]);
    }

    public function rules(): array
    {
        // Se sua rota usa {menu} com binding, isso pode vir Model; se usa {id}, virá número.
        $routeParam = $this->route('menu') ?? $this->route('id');
        $menuId = $routeParam instanceof Menu ? $routeParam->getKey() : (is_numeric($routeParam) ? (int) $routeParam : null);

        return [
            'nome'            => ['required','string','min:2','max:255', Rule::unique('menus','nome')->ignore($menuId)],
            'url'             => ['nullable','string','max:500'],
            'slug'            => ['nullable','string','max:255', Rule::unique('menus','slug')->ignore($menuId)],
            'tipo_menu'       => ['required', Rule::in(['simples','dropdown','mega_menu','categoria'])],
            'menu_pai_id'     => ['nullable','integer','exists:menus,id'],
            'categoria_id'    => ['nullable','integer','exists:menus,id'],
            'icone'           => ['nullable','string','max:100'],
            'descricao'       => ['nullable','string','max:1000'],
            'posicao'         => ['required','integer','min:1','max:3'],
            'ordem'           => ['nullable','integer','min:0'],
            'target'          => ['required','boolean'],
            'pagina_interna'  => ['required','boolean'],
            'cor_destaque'    => ['nullable','string','size:7','regex:/^#[0-9A-Fa-f]{6}$/'],
            'ativo'           => ['required','boolean'],
            'configuracao'    => ['nullable','array'],

            // Se no update você aceita imagem, habilite:
            'img'             => [$this->isMethod('PUT') || $this->isMethod('PATCH') ? 'nullable' : 'sometimes','image','max:300'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            $tipo        = $this->input('tipo_menu');
            $menuPaiId   = $this->input('menu_pai_id');
            $categoriaId = $this->input('categoria_id');

            // Regra condicional 1: se tipo = categoria, precisa ter menu pai
            if ($tipo === 'categoria' && empty($menuPaiId)) {
                $v->errors()->add('menu_pai_id', 'Categorias devem ter um menu pai.');
            }

            // Regra condicional 2: se categoria_id vier, tem que apontar para um menu do tipo 'categoria'
            if (!empty($categoriaId)) {
                $categoria = Menu::find($categoriaId);
                if (!$categoria || $categoria->tipo_menu !== 'categoria') {
                    $v->errors()->add('categoria_id', 'Categoria inválida.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'nome.required'          => 'Informe o nome.',
            'nome.min'               => 'Nome muito curto.',
            'nome.max'               => 'Nome muito longo.',
            'nome.unique'            => 'Já existe um menu com esse nome.',
            'slug.unique'            => 'O slug informado já está em uso.',
            'tipo_menu.required'     => 'Informe o tipo de menu.',
            'tipo_menu.in'           => 'Tipo de menu inválido.',
            'posicao.required'       => 'Informe a posição.',
            'posicao.integer'        => 'Posição precisa ser um número.',
            'posicao.min'            => 'Posição inválida.',
            'posicao.max'            => 'Posição inválida.',
            'cor_destaque.regex'     => 'Informe uma cor no formato hexadecimal (#RRGGBB).',
            'target.required'        => 'Campo obrigatório.',
            'target.boolean'         => 'Target deve ser booleano.',
            'pagina_interna.required'=> 'Campo obrigatório.',
            'pagina_interna.boolean' => 'Página interna deve ser booleano.',
            'ativo.required'         => 'Campo obrigatório.',
            'ativo.boolean'          => 'Ativo deve ser booleano.',
            'configuracao.array'     => 'Configuração deve ser um array.',
            'img.image'              => 'O arquivo deve ser uma imagem.',
            'img.max'                => 'A imagem deve ter no máximo 300 KB.',
        ];
    }
}
