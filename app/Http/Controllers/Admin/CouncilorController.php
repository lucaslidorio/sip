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
       
        $councilors = $this->repository->paginate(10);
        //dd($councilors);
        return view('admin.pages.councilors.index', compact('councilors'));
    }

    
    public function create()
    {
        $parties = $this->party->all();
        return view('admin.pages.councilors.create', compact('parties'));
    }
    
    public function store(StoreUpadateCouncilor $request)
    {
        $dadosCouncilor = $request->all();    

        if($request->hasFile('img') && $request->img->isValid()){
            $dadosCouncilor['img'] = $request->img->store('councilors');
        } 
        
        $this->repository->create($dadosCouncilor);
        
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    }

    
    public function show($id)
    {
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
        //dd('chegou aqui');
        $councilor =  $this->repository->where('id', $id)->first();
        if(!$councilor){
            redirect()->back();
        }
        
        $dadosCouncilor= $request->all();
        if($request->hasFile('img') && $request->img->isValid()){
            if(Storage::exists($councilor->img)){
               Storage::delete($councilor->img);
            }
           
            $dadosCouncilor['img'] = $request->img->store('councilors');
        }      
        $councilor->update($dadosCouncilor);

        toast('Parlamentar atualizado com sucesso!','success')->toToast('top') ;
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
         $pesquisar = $request->except('_token');
         $councilors = $this->repository->search($request->pesquisa);

        return view('admin.pages.councilors.index', [
            'councilors' => $councilors,
            'pesquisar' => $pesquisar
        ]);
    }
}
