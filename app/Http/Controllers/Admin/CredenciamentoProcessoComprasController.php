<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AnexosCredenciamentos;
use App\Models\AnexosCredenciamentosProcessos;
use App\Models\AnexosProcessoCompra;
use App\Models\CredenciamentosProcessosCompras;
use App\Models\MovimentacoesCredenciamentos;
use App\Models\ProcessoCompras;
use App\Models\TypeDocument;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class CredenciamentoProcessoComprasController extends Controller
{

    private $type_document, $repository;
    public function __construct( TypeDocument $type_document,  CredenciamentosProcessosCompras $credenciamento_compras)
    {
        $this->type_document = $type_document;
        $this->repository = $credenciamento_compras;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {       
        $this->authorize('ver-processos-usuario-externo');
        try {
           
            $processo = ProcessoCompras::findOrFail($id);        
            $user = auth()->user();
            $dado_pessoa_id = $user->dadosPessoais->id; 
            $message = "Para concluir a solicitação de credenciamento, anexe os documentos solicitado no edital e clique no botão Concluir.";
            $type_documents = $this->type_document->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
            
            if($processo->proceeding_situation_id != 33){
                toast('Processo não esta recebendo novos credenciamentos!','error')->toToast('top') ; 
                return redirect()->route('processos.index');
            }
            // Verificar se já existe um registro com dado_pessoa_id e processo_compra_id
            $credenciamento = CredenciamentosProcessosCompras::where('dado_pessoa_id', $dado_pessoa_id)
                                                      ->where('processo_compra_id', $processo->id)
                                                      ->first();

            if ($credenciamento) {
                // Redirecionar se já existe                
                $ultimaMovimentacao = $credenciamento->ultimaMovimentacao()->first();
                return view('admin.pages.processos.credenciamento._partials.documentos', 
                                                                compact('processo', 
                                                                    'credenciamento',
                                                                    'ultimaMovimentacao', 
                                                                    'message',
                                                                    'type_documents'));
            }                  
            
            $credenciamentoData=[
                'dado_pessoa_id' => $dado_pessoa_id,
                'processo_compra_id' => $processo->id,
                'user_id' => $user->id,
            ];    

            $credenciamento = CredenciamentosProcessosCompras::create($credenciamentoData);             
           
            $movimentacao = new MovimentacoesCredenciamentos();
            $movimentacao->credenciamento_compra_id = $credenciamento->id;;
            $movimentacao->tipo_movimentacao_id = 1;
            $movimentacao->user_id = $user->id;          
            $movimentacao->save();          
            $ultimaMovimentacao = $credenciamento->ultimaMovimentacao()->first();
            
         
            return view('admin.pages.processos.credenciamento._partials.documentos', 
                                                                compact(
                                                                    'processo', 
                                                                    'credenciamento',                                                                    
                                                                    'movimentacao',
                                                                    'ultimaMovimentacao',
                                                                    'message', 
                                                                    'type_documents',
                                                                    ));

        } catch (ModelNotFoundException $e) {
            // Se o processo não for encontrado, retorna uma resposta 404
            return response()->view('admin.pages.errors.404', ['message' => 'Processo não encontrado.'], 404);
            
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, $movimentacao_id = null)
    {
        $this->authorize('ver-processos-usuario-externo');
        try {
           
            $credenciamento = CredenciamentosProcessosCompras::findOrFail($id);     
            $user = auth()->user();           
            if ($user->id === $credenciamento->user_id && $user->dadosPessoais->id === $credenciamento->dado_pessoa_id) {
                // Redirecionar se há 
                // Verifica se esta fazendo o credenciamento ou solicitação de complementação, e modifica a movimentação               
                if ($movimentacao_id) {
                    $tipoMovimentacaoId = $movimentacao_id; //9 Solicitação de Complementação Eviada pelo Credenciado
                } else {
                    $tipoMovimentacaoId = 2;
                }               
                               
                // Solicitação de Credenciamento (Documentação enviada para analise)
                $credenciamento->tiposMovimentacoes()->attach($tipoMovimentacaoId, [                    
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);             
                toast('Credeciamento efetuado com sucesso!','success')->toToast('top') ; 
                return redirect()->route('processos.index');
            }  
            

        } catch (ModelNotFoundException $e) {
            // Se o processo não for encontrado, retorna uma resposta 404
            return response()->view('admin.pages.errors.404', ['message' => 'Erro ao credenciar o processo.'], 404);
            
        }
    }

    public function storeDocumentoCredenciamento(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:3072', // PDF only and max 3MB
            'type_document_id' => 'required|integer|exists:type_documents,id',
            'credenciamento_compra_id' => 'required|integer|exists:credenciamentos_processos_compras,id',           
        ]);
    
       
        $credenciamentoId = $request->input('credenciamento_compra_id');        
    
        // Iniciar uma transação
        DB::beginTransaction();
        try {
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('anexos_credenciamentos');

                // Salvar os dados no banco de dados
                AnexosCredenciamentos::create([
                    'credenciamento_compra_id' => $credenciamentoId,
                    'type_document_id' => $request->input('type_document_id'),
                    'anexo' => $path,
                    'nome_original' => $file->getClientOriginalName(),
                    
                ]);

                // Commit da transação se tudo ocorreu bem
                DB::commit();

                return response()->json(['message' => 'Arquivo enviado com sucesso!'], 200);
            
            }
        } catch (\Exception $e) {
            // Rollback da transação em caso de erro
            DB::rollback();
            return response()->json(['error' => 'Erro ao processar o upload'], 500);
        }
    
        return response()->json(['error' => 'No files uploaded'], 400);

    }

    public function getUploadedDocuments($credenciamento_compra_id)
    {
        $documents = AnexosCredenciamentos::where('credenciamento_compra_id', $credenciamento_compra_id)
            ->get()
            ->map(function ($document) {
                return [
                    'id' => $document->id,
                    'type_document_id' => $document->type_document_id,
                    'filename' => $document->anexo,'filename' => $document->anexo,
                    'original_name' => $document->nome_original,
                    'url' => config('app.aws_url') . $document->anexo,
                    'size' => Storage::disk('s3')->size($document->anexo)
                ];
            });

        return response()->json($documents);
    }

    

    public function deleteDocumentoCredenciamento($id)
    {

        DB::beginTransaction();
        try {
            // Encontrar o documento pelo ID
            $documento = AnexosCredenciamentos::findOrFail($id);        

            // Verifica se o arquivo existe no storage e deleta do storage
            if (Storage::disk('s3')->exists($documento->anexo)) {
                Storage::disk('s3')->delete($documento->anexo);
            }
            // Exclua o registro do banco de dados
            $documento->delete();
            // Commit da transação
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Documento deletado com sucesso.']);

        } catch (\Exception $e) {
                // Rollback da transação em caso de erro
                DB::rollback();

                // Registrar o erro para depuração
                Log::error('Erro ao deletar documento: ' . $e->getMessage());

                // Retornar uma mensagem de erro ao usuário
                return response()->json(['success' => false, 'message' => 'Erro ao deletar o documento.'], 500);
            
        }
   
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function receberCredenciamento ($id)
    {        
        if (!Gate::any(['editar-processo-compras'])) {
            abort(403, 'Ação não autorizada.');
        }        
        $credenciamento = $this->repository::with('movimentacoes')->findOrFail($id);   
        if (!$credenciamento) {   
            return redirect()->back();
        }
        $user = auth()->user();
        $tipoMovimentacaoId = 3; // Recebebido (Documentação em Analise)
        $credenciamento->tiposMovimentacoes()->attach($tipoMovimentacaoId, [                    
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        toast('Credeciamento recebido com sucesso!','success')->toToast('top') ; 
        return redirect()->route('processos.credenciados', $credenciamento->processo_compra_id);
    }
    public function solicitarComplementacao(Request $request){      

        $request->validate([
            'observacao' => 'required|string|max:255',
            'credenciamento_id' => 'required|exists:credenciamentos_processos_compras,id',
        ]);    
        
        $user = auth()->user();
        $tipoMovimentacaoId = 4; // Solicitação de Complementação
        $credenciamento = CredenciamentosProcessosCompras::findOrFail($request->credenciamento_id);
    
        // Criar a movimentação
        $credenciamento->tiposMovimentacoes()->attach($tipoMovimentacaoId, [                    
            'user_id' => $user->id,
            'observacao' => $request->observacao,
            'created_at' => now(),
            'updated_at' => now(),
        ]);        
        toast('Complementação solicitada com sucesso!','success')->toToast('top') ;
        return redirect()->route('processos.credenciados', $credenciamento->processo_compra_id );
    
    }
        /**
     * Enviar complementação para o orgão solicitante.
    */
    public function createEnviarComplementacao($processo_id, $credenciamento_compra_id){      
    
        $this->authorize('ver-processos-usuario-externo');
        try {
           
            $processo = ProcessoCompras::findOrFail($processo_id);        
            $user = auth()->user();
            $dado_pessoa_id = $user->dadosPessoais->id; 
            $message = "Envie as informacões solicitadas para complementação.";
            $movimentacao_id = 9;
            $type_documents = $this->type_document->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
            
            
            // Verificar se já existe um registro com dado_pessoa_id e processo_compra_id
            $credenciamento = $this->repository->findOrFail($credenciamento_compra_id);

            if ($credenciamento) {
                // Redirecionar se já existe                
                $ultimaMovimentacao = $credenciamento->ultimaMovimentacao()->first();
                return view('admin.pages.processos.credenciamento._partials.documentos', 
                                                                compact('processo', 
                                                                    'credenciamento',
                                                                    'ultimaMovimentacao', 
                                                                    'message',
                                                                    'movimentacao_id',
                                                                    'type_documents'));
            }            
              
        } catch (ModelNotFoundException $e) {
            // Se o processo não for encontrado, retorna uma resposta 404
            return response()->view('admin.pages.errors.404', ['message' => 'Processo não encontrado.'], 404);
            
        }
       
    }

    public function timeline($id){

       $credenciamento = $this->repository->findOrFail($id);
       $processo = $credenciamento->processo()->first();

      
        return view('admin.pages.processos.credenciamento.timeline', compact('credenciamento', 'processo'));
    }
}
