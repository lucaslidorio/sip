<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpadateCouncilor;
use App\Models\Councilor;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CouncilorController extends Controller
{
  
    private $repository, $party;
    public function __construct(Councilor $councilor, Party $party)
    {
        $this->repository = $councilor;
        $this->party = $party;
        
    }

    public function index()
    {
        $this->authorize('ver-vereador');
        $councilors = $this->repository->paginate(10);
        //dd($councilors);
        return view('admin.pages.councilors.index', compact('councilors'));
    }

    
    public function create()
    {
        $this->authorize('nova-vereador');
        $parties = $this->party->all();
        return view('admin.pages.councilors.create', compact('parties'));
    }
    
    public function store(StoreUpadateCouncilor $request)
    {
        $this->authorize('nova-vereador');
        $dadosCouncilor = $request->all();    

        if($request->hasFile('img') && $request->img->isValid()){
            $dadosCouncilor['img'] = $request->img->store('councilors');
        } 
        
        $this->repository->create($dadosCouncilor);
        
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('councilors.index');
    }

    
    public function show($id)
    {
        $this->authorize('ver-vereador');
        $councilor =$this->repository->where('id', $id)->first();
        if(!$councilor){
            redirect()->back();
        }
        return view('admin.pages.councilors.show',[
            'councilor' =>$councilor
        ]);
    }

   
    public function edit($id)
    {
        $this->authorize('editar-vereador');
        $councilor =$this->repository->where('id', $id)->first();
        $parties = $this->party->all();
        if(!$councilor){
            redirect()->back();
        }
        return view('admin.pages.councilors.edit',[
            'councilor' =>$councilor,
            'parties'=>$parties
        ]);
    }

    public function update(StoreUpadateCouncilor $request, $id)
    {
        $this->authorize('editar-vereador');
        $councilor = $this->repository->where('id', $id)->first();
        if(!$councilor){
            return redirect()->back(); // Adicionei "return" que estava faltando
        }
                // Inicializar o array com todos os dados do request
        $dadosCouncilor = $request->all();        
        // Tratamento para a imagem
        if ($request->hasFile('img') && $request->img->isValid()) {
            // Se existe imagem antiga, tenta excluir
            if (!empty($councilor->img)) {
                try {
                    if (Storage::exists($councilor->img)) {
                        Storage::delete($councilor->img);
                    }
                } catch (\Exception $e) {
                    // Log do erro, mas continua o processo
                    \Log::error('Erro ao deletar imagem anterior: ' . $e->getMessage());
                }
            }            
            // Armazena a nova imagem
            $dadosCouncilor['img'] = $request->img->store('councilors');
        } else {
            // Remove o campo img do array se não foi enviado uma nova imagem
            // Isso evita que o valor seja definido como null
            unset($dadosCouncilor['img']);
        }        
        // Atualiza os dados
        $councilor->update($dadosCouncilor);

        toast('Parlamentar atualizado com sucesso!','success')->toToast('top');
        return redirect()->route('councilors.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-vereador');
        $councilor = $this->repository->where('id', $id)->first();
        if(!$councilor){
            return redirect()->back();                      
        }       
        $councilor->delete();
        toast('Parlamentar excluido com sucesso!','success')->toToast('top');            
        return redirect()->route('councilors.index');
    }

    //metodo de pesquisa
    public function search(Request $request)
    {
        $this->authorize('ver-vereador');
         $pesquisar = $request->except('_token');
         $councilors = $this->repository->search($request->pesquisa);

        return view('admin.pages.councilors.index', [
            'councilors' => $councilors,
            'pesquisar' => $pesquisar
        ]);
    }
}
