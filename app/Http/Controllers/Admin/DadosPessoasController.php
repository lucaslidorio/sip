<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DadosPessoas;
use App\Models\DocumentosPessoas;
use App\Models\TypeDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DadosPessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $user, $repository, $type_document;
    public function __construct(User $user, DadosPessoas $repository, TypeDocument $type_document)
    {
        $this->user = $user;
        $this->repository = $repository;
        $this->type_document = $type_document;
    }

    public function index($id)
    {
        if ($id != Auth::user()->id) {
            return redirect()->route('login');
        }
        $type_documents = $this->type_document->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
        //$user = $this->user->find($id);
        $user = User::with('dadosPessoais.documentosPessoas')->findOrFail($id);
      
      
        return view('admin.pages.perfilUsuarios.index', compact('user', 'type_documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->user_id != Auth::user()->id) {
            return redirect()->route('login');
        }
        $dadosPessoa = $this->repository->where('user_id', $request->user_id)->first();
        
        if($request->hasFile('img') && $request->img->isValid()){
            $dadosPessoa['img'] = $request->img->store('fotos_pessoas');
        } 
        $dadosPessoa->update($request->all());

        toast('Cadastro realizado com sucesso!', 'success')->toToast('top');
        return redirect()->back();
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

    public function storeDocumento(Request $request)
    {
        try {
            // Validação dos dados
            $request->validate([
                'file' => 'required|file|max:5120', // 5MB max
                'type_document_id' => 'required|integer|exists:type_documents,id',
                'data_validade' => 'nullable|date',
            ]);

            $user = auth()->user();           
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('documentos_pessoas');

                // Salvar os dados no banco de dados
                $documento = DocumentosPessoas::create([
                    'user_id' => $user->id, // ou $request->input('user_id') se passado via formulário
                    'dado_pessoa_id' => $user->dadospessoais->id,
                    'type_document_id' => $request->input('type_document_id'),
                    'anexo' => $path,
                    'nome_original' => $file->getClientOriginalName(),
                    'data_validade' => $request->input('data_validade'),
                ]);

                return response()->json(['path' => $path, 'documento' => $documento], 200);
            }

            return response()->json(['error' => 'Nenhum arquivo encontrado'], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Erro ao salvar documento: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao salvar documento: ' . $e->getMessage()], 500);
        }
    }

    public function deleteAttachment($id)
    {
        // $this->authorize('excluir-processo-compras');
        //Recupera a anexo pelo id
        $anexo = DocumentosPessoas::findOrFail($id);
        // Verifica se a quantidade de downloads é maior que 0
        
        $user = auth()->user();

        if($anexo->dado_pessoa_id === $user->dadosPessoais->id){

            //Verifica se pelo nome, se ela existe no storage, e deleta do storage
            if (Storage::disk('s3')->exists($anexo->anexo)) {
                Storage::disk('s3')->delete($anexo->anexo);
            }
            //deleta a referência do banco
            $anexo->delete();
            toast('Anexo  removido com sucesso!', 'success')->toToast('top');
            return redirect()->back();            
         }else{
            return redirect()->back()->with('error', 'Erro ao excluir documento! O documento não pertence a este perfil.');
        }
        
        
    }
}
