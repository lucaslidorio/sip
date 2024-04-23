<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProposition;
use App\Models\AttachmentProposition;
use Illuminate\Support\Str;
use App\Models\Councilor;
use App\Models\ProceedingSituation;
use App\Models\Proposition;
use App\Models\Session;
use App\Models\TipoVoto;
use App\Models\TypeDocument;
use App\Models\TypeProposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

use function PHPSTORM_META\type;

class PropositionController extends Controller
{
    private 
        $repository,
        $type_proposition,
        $type_document,
        $situation,
        $councilor,
        $proceeding_situation,     
        $session,
        $tipo_votos;

    public function __construct(
        Proposition $proposition,
        TypeProposition $type_proposition,
        TypeDocument $type_document,
        ProceedingSituation $situation,
        Councilor $councilor,
        ProceedingSituation $proceeding_situation,
        Session $session
       // TipoVoto $tipo_votos
        
     )
    {
        $this->repository = $proposition;
        $this->type_proposition = $type_proposition;
        $this->type_document = $type_document;
        $this->situation = $situation;
        $this->councilor = $councilor;
        $this->proceeding_situation = $proceeding_situation;
        $this->session = $session;
       // $this->tipo_votos = $tipo_votos;
       
        
    }
    
    public function index(Request $request)
    {
        
        $this->authorize('ver-propositura');
        
        $councilors = $this->councilor->all();
        $situacoes = $this->proceeding_situation->all();
        $filters = $request->except('_token');
       
        $propositions = $this->repository            
            ->when($request->proceeding_situation_id, function ($query, $role) {
                return $query->where('proceeding_situation_id', $role);
            })
            ->when($request->ano, function ($query, $role) {
                return $query->whereYear('data', $role);
            })
            ->when($request->pesquisa, function($query, $role) {
                return $query->where('descricao', 'LIKE', "%$role%");
            })
            ->when($request->ordenacao, function ($query, $role) {
                return $query->orderBy('numero', $role);
            })
            //->orderBy('numero', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        
        return view('admin.pages.propositions.index', compact('propositions', 'councilors', 'situacoes', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('nova-propositura');
        $type_propositions = $this->type_proposition->get();
        $type_documents = $this->type_document->get();
        $situations = $this->situation->get();  
        $councilors = $this->councilor->all();   

        return view('admin.pages.propositions.create',[
            'type_propositions' => $type_propositions,
            'type_documents' => $type_documents,
            'situations' => $situations,
            'councilors' => $councilors,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProposition $request)
    {

        $this->authorize('nova-propositura');
        $dadosProposition = new Proposition();
        $dadosProposition = $request->except('councilors', 'anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosProposition['user_id'] = $user->id;
        $dadosProposition = $this->repository->create($dadosProposition);

        //Captura as seleção do select2 dos outores
        $request->only('councilors');
        if($request->councilors){
            for ($i=0; $i < count($request->councilors); $i++) { 
                $councilorProposition =($request->councilors[$i]);
                $dadosProposition->author()->attach($councilorProposition);
            }
        }
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoProposition = new AttachmentProposition();
                $anexoProposition->user_id = $user->id;
                $anexoProposition->proposition_id = $dadosProposition->id;
                $anexoProposition->anexo = $file->store('attachments_propositions');
                $anexoProposition->type_document_id =$type_document;
                $anexoProposition->nome_original = $nome_original;
                $anexoProposition->save();
                unset($anexoProposition);
            }
        }
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->back();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $proposition = $this->repository->where('id', $id)->first();
       
            $sql = "SELECT                		
				c.nome as vereador,				
				tv.nome as voto
            FROM propositions AS p
            INNER JOIN voto_vereador_proposituras AS vvp ON vvp.proposition_id = p.id
            INNER JOIN councilors AS c ON vvp.councilor_id = c.id
            INNER JOIN tipo_votos AS tv ON vvp.tipo_voto_id = tv.id
            WHERE p.id = ?";

            $votos = DB::select($sql, [$id]);         

        //dd($votos);

        // if (count($votos) > 0) {
        // foreach ($votos as $result) {
           
        
        //     echo "Nome do Vereador: {$result->vereador}" . PHP_EOL;          
        //     echo "Nome do Tipo de Voto: {$result->voto}" . PHP_EOL;
        // }
        // } else {
        // echo "Nenhuma proposição encontrada com ID {$id}.";
        // }


        if (!$proposition) {
            return redirect()->back();
        }
        return view('admin.pages.propositions.show', compact('proposition', 'votos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();
        if (!$proposition) {
            return redirect()->back();
        }
        $type_propositions = $this->type_proposition->get();
        $type_documents = $this->type_document->get();
        $situations = $this->situation->get();  
        $councilors = $this->councilor->all();
        
        //dd($proposition);
        return view('admin.pages.propositions.edit',[
            'proposition' => $proposition,
            'type_propositions' => $type_propositions,
            'type_documents' => $type_documents,
            'situations' => $situations,
            'councilors' => $councilors,
            
        ]);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProposition $request, $id)
    {
        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();
        if (!$proposition) {
            return redirect()->back();
        }

        $dadosProposition = $request->except('councilors', 'anexo', 'type_document_id');  
        $user = auth()->user();
        $dadosProposition['user_id'] = $user->id;
        $proposition->update($dadosProposition);

        //Captura as seleção do select2 dos outores
        $request->only('councilors');        
        if($request->councilors){
            for ($i=0; $i < count($request->councilors); $i++) { 
                $councilorProposition[] =($request->councilors[$i]);
                $proposition->author()->sync($councilorProposition);
            }
        }
        //captura e percorre o array de anexo para fazer os registro e upload
        $anexo = $request->only('anexo', 'type_document_id');
        if ($request->hasFile('anexo')) {
            for ($i=0; $i < count($anexo['anexo']) ; $i++) { 
                $file = $anexo['anexo'][$i];
                $nome_original = Str::upper($anexo['anexo'][$i]->getClientOriginalName());
                $type_document = $request->type_document_id;
                $anexoProposition = new AttachmentProposition();
                $anexoProposition->user_id = $user->id;
                $anexoProposition->proposition_id = $proposition->id;
                $anexoProposition->anexo = $file->store('attachments_propositions');
                $anexoProposition->type_document_id =$type_document;
                $anexoProposition->nome_original = $nome_original;
                $anexoProposition->save();
                unset($anexoProposition);
            }
        }
        toast('Cadastro atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('propositions.index');




    }

    /**code 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('excluir-propositura');
          //recupera o registro pelo id
          $proposition  = $this->repository->where('id', $id)->first();
          if(!$proposition){
              redirect()->back();
          }      
          for ($i=1; $i < count($proposition->attachments) ; $i++) { 
               foreach ($proposition->attachments as $anexo) {
                if(Storage::disk('s3')->exists($anexo->anexo)){
                    Storage::disk('s3')->delete($anexo->anexo);
                }
               }         

          }                    
            
            
          $proposition->delete();
          toast('Propositura excluida com sucesso!','success')->toToast('top');            
          return redirect()->route('propositions.index');    
    }

    public function deleteAttachment($id)
    {
        $this->authorize('excluir-propositura');
        //Recupera a anexo pelo id
        $anexo = AttachmentProposition::where('id', $id)->first();
        //Verifica se pelo nome, se ela existe o storage, e deleta do storage
        if(Storage::disk('s3')->exists($anexo->anexo)){
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();  
        toast('Anexo  removido com sucesso!','success')->toToast('top') ;        
        return redirect()->back();
    }

    public function createVotoCouncilor($id){

        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();
        $sessions = $this->session->orderby('data', 'DESC')->get();
        $situations = $this->situation->get(); 
        $tipo_votos = TipoVoto::all();
        if(!$proposition){
            return redirect()->back();                       
        } 
       
        
      
        return view('admin.pages.propositions.votos.create', [            
            'proposition' => $proposition,           
            'sessions' => $sessions, 
            'tipo_votos' =>$tipo_votos,
            'situations' => $situations
                                   
        ]);    
        
    }
    // Função que alimenta o javascript para preecher com os vereadores da legislatura da sessão selecionada
    public function vereadoresSessao($id){        
        $sessao= $this->session->find($id);
        $vereadoresLegislacao = $sessao->legislature->councilors;

        $tipo_votos = TipoVoto::all();
        $vereadores =[];

        foreach ($vereadoresLegislacao as $key => $vereador) {
            $vereadores[] =[
                'id' => $vereador->id,
                'nome' => $vereador->nome,    
                'tipo_voto_id' => null,            
            ] ;
        }
        return response()->json($vereadores);
    }

    public function storeVotoCouncilor(Request $request, $id){

        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();     
        
        if (!$proposition) {// validação para verificar se existe a propositura
            return redirect()->back();
        }

        try {           
            $proposition->proceeding_situation_id = $request->input('proceeding_situation_id');
            $proposition->save();//Atualizar a situação da propositura.        
    
        } catch (\Throwable $th) {
            toast('Erro ao salvar!','danger')->toToast('top') ;
        }
    
        if($request->councilors){
            try {
                for ($i = 0; $i < count($request->councilors); $i++){                  
                        DB::table('voto_vereador_proposituras')->insert([
                        'proposition_id' => $id,
                        'session_id' => $request->session_id,
                        'councilor_id' => $request->councilors[$i],
                        'tipo_voto_id' => $request->tipo_voto_id[$i] ,
                      ]);              
                }
            } catch (\Exception $e) {
                toast('Erro ao salvar!','danger')->toToast('top') ;
            }            
        }                   
        
        toast('Votos lançado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('propositions.index');

    }

    public function editVotoCouncilor($id){

        $this->authorize('editar-propositura');        

        $proposition = $this->repository->where('id', $id)->first();
        $sessions = $this->session->orderby('data', 'DESC')->get();
        $situations = $this->situation->get(); 
        $tipo_votos = TipoVoto::all();      
        

        if(!$proposition){
            return redirect()->back();                       
        }     

        return view('admin.pages.propositions.votos.edit', [            
            'proposition' => $proposition,           
            'sessions' => $sessions, 
            'tipo_votos' =>$tipo_votos,
            'situations' =>$situations
                                   
        ]);
    }

    public function updateVotoCouncilor(Request $request, $id){     

        $this->authorize('editar-propositura');
        $proposition = $this->repository->where('id', $id)->first();   
               
        if (!$proposition) {// validação para verificar se existe a propositura
            return redirect()->back();
        }

        try {
            $proposition->votos_propositura()->detach();// Apaga todos os votos para essa propositura
            $proposition->proceeding_situation_id = $request->input('proceeding_situation_id');
            $proposition->save();//Atualizar a situação da propositura.        
    
        } catch (\Throwable $th) {
            toast('Erro ao salvar!','danger')->toToast('top') ;
        }      

        if($request->councilors){
            try {
                for ($i = 0; $i < count($request->councilors); $i++){                  
                        DB::table('voto_vereador_proposituras')->insert([
                        'proposition_id' => $id,
                        'session_id' => $request->session_id,
                        'councilor_id' => $request->councilors[$i],
                        'tipo_voto_id' => $request->tipo_voto_id[$i] ,
                      ]);              
                }
            } catch (\Exception $e) {
                toast('Erro ao salvar!','danger')->toToast('top') ;
            }            
        }  
        //return redirect()->back();             
        
        toast('Votos atualizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('propositions.index');

    }
}
