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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CredenciamentoProcessoComprasController extends Controller
{

    private $type_document;
    public function __construct( TypeDocument $type_document)
    {
        $this->type_document = $type_document;
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
       
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $this->authorize('ver-processos-usuario-externo');
        try {
           
            $processo = ProcessoCompras::findOrFail($id);        
            $user = auth()->user();
            $dado_pessoa_id = $user->dadosPessoais->id; 
            $message = "Para concluir a solicitação de credenciamento, anexe os documentos solicitado no edital.";
            $type_documents = $this->type_document->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
            
            // Verificar se já existe um registro com dado_pessoa_id e processo_compra_id
            $credenciamento = CredenciamentosProcessosCompras::where('dado_pessoa_id', $dado_pessoa_id)
                                                      ->where('processo_compra_id', $processo->id)
                                                      ->first();

            if ($credenciamento) {
                // Redirecionar se já existe
                $documentos = $credenciamento->documentos()->get();
                $ultimaMovimentacao = $credenciamento->ultimaMovimentacao()->first();
                return view('admin.pages.processos.credenciamento._partials.documentos', 
                                                                compact('processo', 
                                                                    'credenciamento',
                                                                    'ultimaMovimentacao', 
                                                                    'message',
                                                                    'type_documents',
                                                                    'documentos'));
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
            $documentos = $credenciamento->documentos()->get();
         
            return view('admin.pages.processos.credenciamento._partials.documentos', 
                                                                compact(
                                                                    'processo', 
                                                                    'credenciamento',
                                                                    'documentos',
                                                                    'movimentacao',
                                                                    'ultimaMovimentacao',
                                                                    'message', 
                                                                    'type_documents',
                                                                    'documentos'));

        } catch (ModelNotFoundException $e) {
            // Se o processo não for encontrado, retorna uma resposta 404
            return response()->view('admin.pages.errors.404', ['message' => 'Processo não encontrado.'], 404);
            
        }
    }

    public function storeDocumentoCredenciamento(Request $request)
    {
        $request->validate([
            'file.*' => 'required|file|mimes:pdf|max:3072', // PDF only and max 3MB
            'type_document_id' => 'required|integer|exists:type_documents,id',
            'data_validade' => 'nullable|date',
        ]);
    
        $user = auth()->user();
        $credenciamentoId = $request->input('credenciamento_compra_id');
        $tipoMovimentacaoId = 2;
    
        // Iniciar uma transação
        DB::beginTransaction();
        try {
            // Verificar se já existe uma movimentação do mesmo tipo nos últimos 60 segundos
            $ultimaMovimentacao = MovimentacoesCredenciamentos::where('credenciamento_compra_id', $credenciamentoId)
                ->where('tipo_movimentacao_id', $tipoMovimentacaoId)
                ->where('created_at', '>=', now()->subMinute())
                ->lockForUpdate() // Lock the row for update
                ->first();
    
            if (!$ultimaMovimentacao) {
                // Criar nova movimentação se não houver uma recente
                $movimentacao = new MovimentacoesCredenciamentos();
                $movimentacao->credenciamento_compra_id = $credenciamentoId;
                $movimentacao->tipo_movimentacao_id = $tipoMovimentacaoId;
                $movimentacao->user_id = $user->id;
                $movimentacao->save();
            } else {
                // Usar a última movimentação se já houver uma recente
                $movimentacao = $ultimaMovimentacao;
            }
    
            if ($request->hasFile('file')) {
                foreach ($request->file('file') as $file) {
                    $path = $file->store('anexos_credenciamentos');
    
                    // Salvar os dados no banco de dados
                    $documento = AnexosCredenciamentos::create([
                        'credenciamento_compra_id' => $credenciamentoId,
                        'type_document_id' => $request->input('type_document_id'),
                        'anexo' => $path,
                        'nome_original' => $file->getClientOriginalName(),
                        'data_validade' => $request->input('data_validade'),
                    ]);
                }
    
                // Commit da transação se tudo ocorreu bem
                DB::commit();
    
                return response()->json(['message' => 'Arquivos enviados com sucesso!'], 200);
            }
        } catch (\Exception $e) {
            // Rollback da transação em caso de erro
            DB::rollback();
            return response()->json(['error' => 'Erro ao processar o upload'], 500);
        }
    
        return response()->json(['error' => 'No files uploaded'], 400);


        // try {
        //     // Validação dos dados
        //     $request->validate([
        //         'file' => 'required|file|mimes:pdf|max:3072', // PDF only and max 3MB
        //         'type_document_id' => 'required|integer|exists:type_documents,id',
        //         'data_validade' => 'nullable|date',
        //     ]);
                  
        //     $user = auth()->user();
        //     $credenciamentoId = $request->input('credenciamento_compra_id');
        //     $tipoMovimentacaoId = 2;
        
        //     // Verificar se já existe uma movimentação do mesmo tipo nos últimos 60 segundos
        //     $ultimaMovimentacao = MovimentacoesCredenciamentos::where('credenciamento_compra_id', $credenciamentoId)
        //         ->where('tipo_movimentacao_id', $tipoMovimentacaoId)
        //         ->where('created_at', '>=', now()->subMinute())
        //         ->first();
        
        //     if (!$ultimaMovimentacao) {
        //         // Criar nova movimentação se não houver uma recente
        //         $movimentacao = new MovimentacoesCredenciamentos();
        //         $movimentacao->credenciamento_compra_id = $credenciamentoId;
        //         $movimentacao->tipo_movimentacao_id = $tipoMovimentacaoId;
        //         $movimentacao->user_id = $user->id;
        //         $movimentacao->save();
        //     } else {
        //         // Usar a última movimentação se já houver uma recente
        //         $movimentacao = $ultimaMovimentacao;
        //     }



            
        //     if ($request->hasFile('file')) {
        //         $file = $request->file('file');
        //         $path = $file->store('anexos_credenciamentos');
        //         // Salvar os dados no banco de dados
        //         $documento = AnexosCredenciamentos::create([                  
        //             'credenciamento_compra_id' => $request->input('credenciamento_compra_id'),
        //             'type_document_id' => $request->input('type_document_id'),
        //             'anexo' => $path,
        //             'nome_original' => $file->getClientOriginalName(),
        //             'data_validade' => $request->input('data_validade'),
        //         ]);

        //         return response()->json(['path' => $path, 'documento' => $documento], 200);
        //     }
        //     return response()->json(['error' => 'Nenhum arquivo encontrado'], 400);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     return response()->json(['error' => $e->errors()], 422);
        // } catch (\Exception $e) {
        //     Log::error('Erro ao salvar documento: ' . $e->getMessage());
        //     return response()->json(['error' => 'Erro ao salvar documento: ' . $e->getMessage()], 500);
        // }
    }
    

    public function deleteDocumento($id)
    {
     
        $documento = AnexosCredenciamentos::findOrFail($id);

        return response()->json(['success' => true, 'message' => 'Documento deletado com sucesso.']);
        // $filePath = public_path('path/to/uploads/' . $documento->filename);

        // // Delete the file from the server
        // if (file_exists($filePath)) {
        //     unlink($filePath);
        // }

        // // Delete the record from the database
        // $documento->delete();

        // return response()->json(['success' => 'Documento deletado com sucesso!']);
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
}
