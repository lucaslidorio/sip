<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Menu::with(['parent', 'categoria', 'children']);

        // Filtros
        if ($request->filled('tipo_menu')) {
            $query->where('tipo_menu', $request->tipo_menu);
        }

        if ($request->filled('posicao')) {
            $query->where('posicao', $request->posicao);
        }

        if ($request->filled('ativo')) {
            $query->where('ativo', $request->ativo);
        }

        if ($request->filled('pesquisa')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->pesquisa . '%')
                  ->orWhere('url', 'like', '%' . $request->pesquisa . '%')
                  ->orWhere('descricao', 'like', '%' . $request->pesquisa . '%');
            });
        }

        // Ordenação hierárquica
        $menus = $query->orderBy('posicao')
                      ->orderBy('ordem')
                      ->paginate(20);

        // Dados para filtros
        $menusPais = Menu::whereNull('menu_pai_id')
                        ->orderBy('nome')
                        ->get();

        $categorias = Menu::where('tipo_menu', 'categoria')
                         ->orderBy('nome')
                         ->get();

        return view('admin.pages.menus.index', compact('menus', 'menusPais', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menusPais = Menu::whereIn('tipo_menu', ['dropdown', 'mega_menu'])
                        ->orderBy('nome')
                        ->get();

        $categorias = Menu::where('tipo_menu', 'categoria')
                         ->orderBy('nome')
                         ->get();

        return view('admin.pages.menus.create', compact('menusPais', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('novo-menu');
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'slug' => 'nullable|string|max:255|unique:menus,slug',
            'tipo_menu' => 'required|in:simples,dropdown,mega_menu,categoria',
            'menu_pai_id' => 'nullable|exists:menus,id',
            'categoria_id' => 'nullable|exists:menus,id',
            'icone' => 'nullable|string|max:100',
            'descricao' => 'nullable|string|max:1000',
            'posicao' => 'required|integer|min:1|max:3',
            'ordem' => 'nullable|integer|min:0',
            'target' => 'boolean',
            'pagina_interna' => 'boolean',
            'cor_destaque' => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'ativo' => 'boolean',
            'configuracao' => 'nullable|array'
        ]);

        // Validações específicas
        if ($validated['tipo_menu'] === 'categoria' && empty($validated['menu_pai_id'])) {
            return back()->withErrors(['categoria_id' => 'Categorias devem ter um menu pai.'])->withInput();
        }

        if (!empty($validated['categoria_id'])) {
            $categoria = Menu::find($validated['categoria_id']);
            if (!$categoria || $categoria->tipo_menu !== 'categoria') {
                return back()->withErrors(['categoria_id' => 'Categoria inválida.'])->withInput();
            }
        }

        // Gerar slug se não informado
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['nome']);
        }

        // Definir ordem se não informada
        if (empty($validated['ordem'])) {
            $maxOrdem = Menu::where('menu_pai_id', $validated['menu_pai_id'])
                           ->where('posicao', $validated['posicao'])
                           ->max('ordem');
            $validated['ordem'] = ($maxOrdem ?? 0) + 1;
        }

        try {
            DB::beginTransaction();
            
            $menu = Menu::create($validated);
            
            DB::commit();

            return redirect()->route('admin.menus.index')
                           ->with('success', 'Menu criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao criar menu: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('ver-menu');
        $menu = Menu::with(['parent', 'categoria', 'children.children', 'categorias.itensCategoria'])->findOrFail($id);
        
        
        $menu->load(['parent', 'categoria', 'children.children', 'categorias.itensCategoria']);        
       
        return view('admin.pages.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);

        $menusPais = Menu::where('tenant_id', auth()->user()->tenant_id)
                        ->whereIn('tipo_menu', ['dropdown', 'mega_menu'])
                        ->where('id', '!=', $menu->id)
                        ->orderBy('nome')
                        ->get();

        $categorias = Menu::where('tenant_id', auth()->user()->tenant_id)
                         ->where('tipo_menu', 'categoria')
                         ->where('id', '!=', $menu->id)
                         ->orderBy('nome')
                         ->get();

                        

        return view('admin.menus.edit', compact('menu', 'menusPais', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $this->authorize('update', $menu);

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'url' => 'nullable|string|max:500',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('menus')->ignore($menu->id)],
            'tipo_menu' => 'required|in:simples,dropdown,mega_menu,categoria',
            'menu_pai_id' => 'nullable|exists:menus,id',
            'categoria_id' => 'nullable|exists:menus,id',
            'icone' => 'nullable|string|max:100',
            'descricao' => 'nullable|string|max:1000',
            'posicao' => 'required|integer|min:1|max:3',
            'ordem' => 'required|integer|min:0',
            'target' => 'boolean',
            'pagina_interna' => 'boolean',
            'cor_destaque' => 'nullable|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'ativo' => 'boolean',
            'configuracao' => 'nullable|array'
        ]);

        // Validar hierarquia (não pode ser pai de si mesmo)
        if ($validated['menu_pai_id'] == $menu->id) {
            return back()->withErrors(['menu_pai_id' => 'Um menu não pode ser pai de si mesmo.'])->withInput();
        }

        // Gerar slug se não informado
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['nome']);
        }

        try {
            DB::beginTransaction();
            
            $menu->update($validated);
            
            DB::commit();

            return redirect()->route('admin.menus.index')
                           ->with('success', 'Menu atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao atualizar menu: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->authorize('delete', $menu);

        try {
            DB::beginTransaction();
            
            // Verificar se tem filhos
            if ($menu->children()->count() > 0) {
                return back()->withErrors(['error' => 'Não é possível excluir um menu que possui submenus.']);
            }

            $menu->delete();
            
            DB::commit();

            return redirect()->route('admin.menus.index')
                           ->with('success', 'Menu excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao excluir menu: ' . $e->getMessage()]);
        }
    }

    /**
     * Reordenar menus via AJAX
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:menus,id',
            'items.*.ordem' => 'required|integer|min:0'
        ]);

        try {
            DB::beginTransaction();

            foreach ($validated['items'] as $item) {
                Menu::where('id', $item['id'])
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->update(['ordem' => $item['ordem']]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Ordem atualizada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Erro ao reordenar: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Alternar status ativo/inativo
     */
    public function toggleStatus(Menu $menu)
    {
        $this->authorize('update', $menu);

        try {
            $menu->update(['ativo' => !$menu->ativo]);

            $status = $menu->ativo ? 'ativado' : 'desativado';
            
            return response()->json([
                'success' => true, 
                'message' => "Menu {$status} com sucesso!",
                'ativo' => $menu->ativo
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erro ao alterar status: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Duplicar menu
     */
    public function duplicate(Menu $menu)
    {
        $this->authorize('create', Menu::class);

        try {
            DB::beginTransaction();

            $novoMenu = $menu->replicate();
            $novoMenu->nome = $menu->nome . ' (Cópia)';
            $novoMenu->slug = $menu->slug . '-copia';
            $novoMenu->ordem = $menu->ordem + 1;
            $novoMenu->ativo = false; // Criar inativo por segurança
            $novoMenu->save();

            DB::commit();

            return redirect()->route('admin.menus.edit', $novoMenu)
                           ->with('success', 'Menu duplicado com sucesso! Lembre-se de ativá-lo quando estiver pronto.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao duplicar menu: ' . $e->getMessage()]);
        }
    }

    /**
     * Preview do menu (AJAX)
     */
    public function preview(Request $request)
    {
        $menus = Menu::with(['children.children', 'categorias.itensCategoria'])
                    ->where('tenant_id', auth()->user()->tenant_id)
                    ->where('posicao', $request->get('posicao', 1))
                    ->principais()
                    ->ativos()
                    ->ordenado()
                    ->get();

        return response()->json([
            'html' => view('admin.menus.preview', compact('menus'))->render()
        ]);
    }

    /**
     * Buscar menus para select2 (AJAX)
     */
    public function search(Request $request)
    {
        $term = $request->get('q');
        $tipo = $request->get('tipo');

        $query = Menu::where('tenant_id', auth()->user()->tenant_id)
                    ->where('ativo', true);

        if ($term) {
            $query->where('nome', 'like', "%{$term}%");
        }

        if ($tipo) {
            $query->where('tipo_menu', $tipo);
        }

        $menus = $query->orderBy('nome')
                      ->limit(20)
                      ->get(['id', 'nome', 'tipo_menu']);

        return response()->json([
            'results' => $menus->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'text' => $menu->nome . ' (' . ucfirst($menu->tipo_menu) . ')'
                ];
            })
        ]);
    }
}

