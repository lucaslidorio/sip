<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOuvidoriaSite;
use App\Models\AnexoOuvidoria;
use App\Models\AssuntoOuvidoria;
use App\Models\OrgaoOuvidoria;
use App\Models\Ouvidoria;
use App\Models\PerfilOuvidoria;
use App\Models\Tenant;
use App\Models\TipoOvidoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OuvidoriaSiteController extends Controller
{
    private $tenant, $tipos_ouvidorias, 
            $perfis_ouvidoria, 
            $orgaos_ouvidoria, 
            $assuntos_ouvidoria,
            $repository;
    public function __construct(
            Tenant $tenant, 
            TipoOvidoria $tipo_ouvidoria, 
            PerfilOuvidoria $perfis_ouvidoria,
            OrgaoOuvidoria $orgao_ouvidoria,
            AssuntoOuvidoria $assunto_ouvidoria,
            Ouvidoria $repository,
        )
    {
        $this->tenant = $tenant;
        $this->tipos_ouvidorias = $tipo_ouvidoria;
        $this->perfis_ouvidoria = $perfis_ouvidoria;
        $this->orgaos_ouvidoria = $orgao_ouvidoria;
        $this->assuntos_ouvidoria = $assunto_ouvidoria;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $tenants = $this->tenant->where('id', 3)->get();
            $cliente = $this->tenant->first();
            $tipos_ouvidoria = $this->tipos_ouvidorias->get();
            

                     
              
            return view('site.layouts..ouvidoria.index', [
                'cliente' => $cliente,
                'tenants' =>  $tenants,
                'tipos_ouvidoria' =>$tipos_ouvidoria,
            ]);
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_ouvidoria)
    {  
        
        $tenants = $this->tenant->where('id', 3)->get();
        $cliente = $this->tenant->first();
        $tipo_ouvidoria = $this->tipos_ouvidorias->findOrfail($id_ouvidoria);
        $perfis_ouvidoria = $this->perfis_ouvidoria->where('situacao', true)->get();
        $orgaos_ouvidoria = $this->orgaos_ouvidoria->where('situacao', true)->get();
        $assuntos_ouvidoria = $this->assuntos_ouvidoria->where('situacao', true)->get();
        
        return view('site.layouts..ouvidoria.form', compact(
            'cliente',  
            'tenants', 
            'tipo_ouvidoria', 
            'perfis_ouvidoria',
            'orgaos_ouvidoria',
            'assuntos_ouvidoria',
        
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateOuvidoriaSite $request)
    {
                 
        $cliente = $this->tenant->first();   
        $tenants = $this->tenant->where('id', 3)->get();

        //captura e percorre o array de anexo para fazer os registro e upload
        $codigo =Str::upper( Str::random(8));       
        $existe_codigo = $this->repository->where('codigo', $codigo )->first();      
        if($existe_codigo != null){
            $codigo=Str::upper( Str::random(8));
        }
        $request->merge(['codigo' => $codigo]);     

        $ouvidoria = $this->repository->create($request->all());


        $anexo = $request->only('anexo');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $anexoOuvidoria = new AnexoOuvidoria();
                $anexoOuvidoria->ouvidoria_id = $ouvidoria->id;
                $anexoOuvidoria->anexo = $file->store('attachments_ombudsman');
                $anexoOuvidoria->nome_original = $nome_original;
                $anexoOuvidoria->save();
                unset($anexoOuvidoria);
            }
        }
        return view('site.layouts..ouvidoria.confirmacao', compact(
            'ouvidoria',
            'cliente',
            'tenants',           
        
        ));

       
              

    }

    public function acompanhamento(Request $request)
    {  
        $tenants = $this->tenant->where('id', 3)->get();
        $cliente = $this->tenant->first();  
        $ouvidoria = $this->repository->where('codigo', $request->codigo)->first();    
        
      
        return view('site.layouts..ouvidoria.acompanhamento', compact(
            'cliente',  
            'tenants',
            'ouvidoria',             
        
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
