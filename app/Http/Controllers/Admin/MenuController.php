<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver-menu');
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
        $this->authorize('novo-menu');
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
    public function store(StoreUpdateMenu $request)
    {
        $this->authorize('novo-menu');

        $validated = $request->validated();

        // Gerar slug se não informado
        if (empty($validated['slug'])) {
            $validated['slug'] = \Str::slug($validated['nome']);
        }

        // Definir ordem se não informada
        if (empty($validated['ordem'])) {
            $maxOrdem = \App\Models\Menu::where('menu_pai_id', $validated['menu_pai_id'] ?? null)
                ->where('posicao', $validated['posicao'])
                ->max('ordem');
            $validated['ordem'] = ($maxOrdem ?? 0) + 1;
        }

        try {
            DB::beginTransaction();

            $menu = \App\Models\Menu::create($validated);

            DB::commit();

            Alert::toast('Menu criado com sucesso!', 'success')->position('top-end');
            return redirect()->route('admin.menus.index');
        } catch (\Throwable $e) {
            DB::rollBack();

            // Você pode usar error bag OU SweetAlert. Aqui vai SweetAlert + redirect back com input
            Alert::toast('Erro ao criar menu: ' . $e->getMessage(), 'error')->position('top-end');
            return back()->withInput();
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
    public function edit($id)
    {
        
        $this->authorize('editar-menu');
        $menu = Menu::findOrFail($id);
        $menusPais = Menu::query()
        ->whereIn('tipo_menu', ['dropdown', 'mega_menu'])
        ->where('id', '!=', $menu->id)
        ->orderBy('nome')
        ->get();


        $categorias = Menu::where('tipo_menu', 'categoria')
            ->where('id', '!=', $menu->id)
            ->orderBy('nome')
            ->get();

        return view('admin.pages.menus.edit', compact('menu', 'menusPais', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateMenu $request, $id)
    {
        $this->authorize('editar-menu');

        $menu = Menu::findOrFail($id);
        $data = $request->validated(); // regras e condicionais já estão no FormRequest

        // Não pode ser pai de si mesmo
        if (isset($data['menu_pai_id']) && (int)$data['menu_pai_id'] === (int)$menu->id) {
            Alert::toast('Um menu não pode ser pai de si mesmo.', 'error')->position('top-end');
            return back()->withInput();
        }

        // Gera slug se vier vazio
        if (empty($data['slug'])) {
            $data['slug'] = \Str::slug($data['nome']);
        }

        try {
            DB::beginTransaction();

            $menu->update($data);

            DB::commit();

            Alert::toast('Menu atualizado com sucesso!', 'success')->position('top-end');
            return redirect()->route('admin.menus.index');
        } catch (\Throwable $e) {
            DB::rollBack();

            Alert::toast('Erro ao atualizar menu: ' . $e->getMessage(), 'error')->position('top-end');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('excluir-menu');
        $menu = Menu::findOrFail($id);


        try {
            DB::beginTransaction();

            // Verificar se tem filhos
            if ($menu->children()->count() > 0) {
                Alert::toast('Não é possível excluir um menu que possui submenus.', 'error')->position('top-end');
                return back();
            }
            $menu->delete();

            DB::commit();

            Alert::toast('Menu excluído com sucesso!', 'success')->position('top-end');
            return redirect()->route('admin.menus.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Alert::toast('Erro ao excluir menu: ' . $e->getMessage(), 'error')->position('top-end');
            return back();
        }
    }

    /**
     * Reordenar menus via AJAX
     */
    // Método para reordenar menus via AJAX
    public function reorder(Request $request)
    {
        $this->authorize('editar-menu');
        $items = $request->input('items', []);

        foreach ($items as $item) {
            Menu::where('id', $item['id'])->update(['ordem' => $item['ordem']]);
        }

        return response()->json(['message' => 'Ordem atualizada com sucesso!']);
    }


    // Método para toggle de status via AJAX
    public function toggleStatus($id)
    {
        $this->authorize('editar-menu');
        $menu = Menu::findOrFail($id);
        $menu->update(['ativo' => !$menu->ativo]);

        return response()->json([
            'message' => 'Status alterado com sucesso!',
            'ativo' => $menu->ativo
        ]);
    }




    /**
     * Preview do menu (AJAX)
     */
    public function preview(Request $request)
    {
        $this->authorize('ver-menu');
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
        $this->authorize('ver-menu');
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
