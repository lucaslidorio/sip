<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquete;
use App\Models\ItemEnquete;
use Illuminate\Http\Request;

class EnqueteController extends Controller
{
    private $enquete, $item;
    public function __construct(Enquete $enquete, ItemEnquete $item)
    {
        $this->enquete = $enquete;
        $this->item = $item;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver-enquete');
        //dd($request->all());
        $search = $request->input('pesquisa');

       
        // Busca as enquetes com base na pesquisa, se houver
        $enquetes = $this->enquete
            ->when($search, function ($query, $search) {
                return $query->where('nome', 'like', '%' .$search. '%');
            })
            ->paginate(10); // Paginação com 10 resultados por página
        return view('admin.pages.enquetes.index', compact('enquetes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {          
        $this->authorize('nova-enquete');
            return view('admin.pages.enquetes.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100', 
            'situacao' => 'required', // PDF somente e máximo de 3MB
        ],);

        $this->authorize('nova-enquete');

        $user = auth()->user();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $this->enquete->create($data);
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('enquetes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('nova-enquete');
            $enquete = $this->enquete->findOrFail($id);
            if(!$enquete){
                return redirect()->back();
                           
            }
            return view('admin.pages.enquetes.edit', compact('enquete')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('editar-enquete');
        $enquete = $this->enquete->where('id', $id)->first();
        if(!$enquete){
            return redirect()->back();                       
        }
        $enquete->update($request->all());
        toast('Equete atualizada com sucesso!','success')->toToast('top') ; 
        return redirect()->route('enquetes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-enquete');
        $enquete = $this->enquete->findOrFail($id);

        $intensComVotos = $enquete->itens()->where('votos','>','0')->count();
        if($intensComVotos > 0){
            toast('Enquete com itens com votos. Não pode ser excluida!','error')->toToast('top');
            return redirect()->back();
        }
        $enquete->itens()->delete();
        $enquete->delete();      
        
        toast('Enquete excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('enquetes.index');
    }

    public function createItem($id){
        $this->authorize('nova-enquete');
        $enquete = $this->enquete->findOrFail($id);
        return view('admin.pages.enquetes.itens.create', ['enquete' => $enquete]);
    }
    
    public function storeItem(Request $request){
        $request->validate([
            'nome' => 'required|string|max:45',             
        ],);
        $this->authorize('nova-enquete');
        $enquete = $this->enquete->findOrFail($request->enquete_id);
        $enquete->itens()->create($request->all());        
        toast('Itens cadastrados com sucesso!', 'success')->toToast('top');
        return redirect()->back();
    }
    public function editItem(string $id)
    {
        $this->authorize('editar-enquete');
            $item = $this->item->findOrFail($id);
            if(!$item){
                return redirect()->back();
                           
            }
        return view('admin.pages.enquetes.itens.edit', ['item' => $item]); 
    }
    public function updateItem(Request $request, string $id)
    {
        $this->authorize('editar-enquete');
        $item = $this->item->findOrFail($id);
        if(!$item){
            return redirect()->back();                       
        }
        $item->update($request->all());
        toast('Item atualizado com sucesso!','success')->toToast('top') ; 
        return redirect()->route('enquetes.createItem', $item->enquete_id);
    }
    public function destroyItem(string $id)
    {
        $this->authorize('excluir-enquete');
        $item = $this->item->findOrFail($id);        
        if($item->votos > 0){
            toast('Item com votos. Não pode ser excluido!','error')->toToast('top');
            return redirect()->back();
        }       
        $item->delete();    
        
        toast('item excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('enquetes.createItem', $item->enquete_id);
    }
}
