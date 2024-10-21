<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentosDof;
use App\Models\SubTipoMateria;
use App\Models\TipoMateria;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateDocumentoDof;
use App\Models\DocumentoAssinaturas;
use App\Models\UserFunction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;


class DocumentoDofController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository, $subTipoMateria, $tipoMateria;
    public function __construct(DocumentosDof $repository, SubTipoMateria $subTipoMateria, TipoMateria $tipoMateria){
        $this->repository = $repository;
        $this->tipoMateria = $tipoMateria;
        $this->subTipoMateria = $subTipoMateria;
    }

    public function index()
    {       
        $this->authorize('ver-documento-dof');
        $documentos = $this->repository->paginate(15);      

        return view('admin.pages.documentosDof.index', compact('documentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-documento-dof');
        $tiposMateria = $this->tipoMateria->get();
        $subTiposMateria = $this->subTipoMateria->get();
        return view('admin.pages.documentosDof.create',compact('subTiposMateria','tiposMateria'));

    }

    public function getSubTiposByTipo($tipo_materia_id)
    {
        // Busca os subtipos relacionados ao tipo de matéria
        $subTipos = $this->subTipoMateria->where('tipo_materia_id', $tipo_materia_id)->get();        
        // Retorna a resposta em formato JSON
        return response()->json($subTipos);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateDocumentoDof $request)
    {        
        $this->authorize('novo-documento-dof');
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['user_id_last_update'] = auth()->user()->id;
        $this->repository->create($data);       
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('documentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $this->authorize('ver-documento-dof');
         // Buscar o documento pelo UUID
        $documento = $this->repository->where('uuid', $uuid)->firstOrFail();  
        
        //dd($documento->assinaturas);  
        return view('admin.pages.documentosDof.show',compact('documento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('editar-documento-dof');
        $documento = DocumentosDof::findOrFail($id);
        $tiposMateria = $this->tipoMateria->get();
        $subTiposMateria = $this->subTipoMateria->get(); 
       //dd($documento);    
        return view('admin.pages.documentosDof.edit',compact('documento', 'subTiposMateria','tiposMateria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateDocumentoDof $request, string $id)
    {
        $this->authorize('editar-documento-dof');

        if($documento = $this->repository->find($id)){
            redirect()->back();
        }
        $data = $request->all();
        $data['user_id'] = $documento->user_id;
        $data['user_id_last_update'] = auth()->user()->id; 

        $documento->update($data);

        toast('Documento atualizado com sucesso!','success')->toToast('top') ;
        return redirect()->route('documentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    ################# FUNÇOES DE ASSINATURA ####################    

    public function getFunctions()
{
    // Recupera o usuário logado
    $user = auth()->user();

    // Busca as funções ativas do usuário na tabela user_functions
    $funcoes = UserFunction::where('user_id', $user->id)
                            ->where('situacao', 1) // Apenas funções ativas
                            ->with('function') // Carrega o nome da função (relacionamento)
                            ->get();

    // Retorna as funções como JSON
   
    return response()->json($funcoes);
}




    public function signDocument(Request $request, string $uuid)
    {
        try {
            $this->authorize('assinar-documento-dof');

            $documento = DocumentosDof::where('uuid', $uuid)->firstOrFail();

            $request->validate([
                'password' => 'required',
                'funcao_id' => 'required|exists:functions,id',
            ]);
        
            // Verifica a senha do usuário para confirmar a assinatura
            if (!Hash::check($request->password, auth()->user()->password)) {
                return response()->json(['error' => 'Senha incorreta.'], 401);
            }
            // Concatenar todos os campos que formam o documento para gerar o hash
            $dadosDocumento = $documento->user_id_last_update
                . $documento->tipo_materia_id
                . $documento->sub_tipo_materia_id
                . $documento->titulo
                . $documento->uuid
                . $documento->conteudo
                . $documento->user_id;

            // Gera o hash do documento a partir de todos os campos relevantes
            $documentoHash = hash('sha256', $dadosDocumento);

            // Verifica se o documento foi alterado comparando o hash atual com o armazenado
            $documentoAlterado = $documento->hash_documento !== $documentoHash;
                // Invalida as assinaturas anteriores caso o documento tenha sido alterado
                Log::info('Documento alterado', ['documento_alterado' => $documentoAlterado]);
                if ($documentoAlterado) {
                    $documento->assinaturas()->update(['status' => false]); // Assinaturas anteriores inválidas
                    $documento->hash_documento = $documentoHash;
                    $documento->save();
                }

            // Verifica se o usuário já assinou o documento com a mesma função e se não houve alteração
            $assinaturaExistenteComMesmaFuncao = $documento->assinaturas()
            ->where('user_id', auth()->id())
            ->where('funcao_id', $request->funcao_id) // Verifica a função
            ->where('status', true) // Verifica se a assinatura está ativa
            ->exists();

           // Bloqueia a nova assinatura se o documento não foi alterado e a função é a mesma
            if ($assinaturaExistenteComMesmaFuncao && !$documentoAlterado) {
                return response()->json(['error' => 'Você já assinou este documento com esta função e ele não foi alterado.'], 403);
            }
                    // Gera o hash da assinatura usando o hash do documento + a senha do usuário
        $assinaturaHash = hash('sha256', $documentoHash . auth()->user()->password);

        // Atualiza o hash do documento no modelo de documento
        $documento->hash_documento = $documentoHash;
        $documento->save();

        // Gera um código de verificação único para a assinatura
        $codigoVerificacaoAssinatura = strtoupper(Str::random(12));
        
        // Registra a assinatura no banco de dados
        DocumentoAssinaturas::create([
            'documento_dof_id' => $documento->id,
            'user_id' => auth()->id(),
            'funcao_id' => $request->funcao_id, // Salva o ID da função selecionada
            'assinatura' => $assinaturaHash, // Armazena o hash da assinatura
            'documento_hash' => $documentoHash,
            'data_assinatura' => now(),
            'codigo_verificacao' => $codigoVerificacaoAssinatura, //Código de verificação único para cada assinatura
            'ip_address' => $request->ip(),
            'navegador' => $request->header('User-Agent'),
        ]);

        return response()->json(['success' => 'Documento assinado com sucesso!']);
        } catch (\Exception $e) {
            // Registrar o erro no log e retornar uma mensagem de erro
            Log::error('Erro ao assinar o documento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno no servidor.'], 500);
        }
    }

    public function verificarDocumento($codigoVerificacao)
    {
        // Buscar o documento pelo código de verificação
        $documento = DocumentosDof::where('codigo_verificacao', $codigoVerificacao)->firstOrFail();

        // Recalcula o hash com base nos campos do documento
        $dadosDocumentoAtual = $documento->user_id_last_update
            . $documento->tipo_materia_id
            . $documento->sub_tipo_materia_id
            . $documento->titulo
            . $documento->uuid
            . $documento->conteudo
            . $documento->user_id;

        // Recalcula o hash do documento
        $documentoHashAtual = hash('sha256', $dadosDocumentoAtual);

        // Verificar se o hash atual é o mesmo que o hash no momento da assinatura
        $hashIntegro = $documento->hash_documento === $documentoHashAtual;

        // Filtrar assinaturas válidas e inválidas
        $assinaturasValidas = $documento->assinaturas->where('status', true);
        $assinaturasInvalidas = $documento->assinaturas->where('status', false);

         // Verifica se o documento tem pelo menos uma assinatura válida
        $documentoIntegro = $hashIntegro && $assinaturasValidas->count() > 0;

        // Data da última alteração que invalidou as assinaturas
        $dataAlteracao = $documento->updated_at;

        // Gerar o QR Code para o código de verificação do documento
        $verificacaoUrl = route('verificador', $codigoVerificacao);
        $qrCode = QrCode::size(200)->generate($verificacaoUrl);

        // Retorna para a view com as assinaturas válidas, inválidas e o QR Code
        return view('admin.pages.documentosDof.verificador', compact(
            'assinaturasValidas', 
            'assinaturasInvalidas', 
            'documentoIntegro', 
            'qrCode', 
            'dataAlteracao',
            'documento'
        ));
    }

}
