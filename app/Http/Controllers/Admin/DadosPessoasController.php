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
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'tipo_pessoa' => 'required|in:F,J',
            'natureza_juridica' => 'nullable|in:EI,LTDA,S/A,OUTRAS',
            'enquadramento' => 'nullable|in:MIC,EPP,GP,DE,COOP',
            'nome_fantasia' => 'nullable|max:255',
            'razao_social' => 'nullable|max:255',
            'cnpj' => 'nullable|max:17',
            'inscricao_estadual' => 'nullable|max:18',
            'data_abertura' => 'nullable|date',
            'site' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'cep' => 'nullable|digits:8',
            'endereco' => 'nullable|max:100',
            'numero' => 'nullable|max:6',
            'bairro' => 'nullable|max:100',
            'cidade' => 'nullable|max:100',
            'estado' => 'nullable|string|max:2',
            // 'telefone' => 'nullable|digits_between:8,18',
            // 'celular' => 'nullable|digits_between:10,18',
            'img' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);  

        if ($request->user_id != Auth::user()->id) {
            return redirect()->route('login');
        }

        
        $dadosPessoa = $this->repository->where('user_id', $request->user_id)->first();
        
        if($request->hasFile('img') && $request->img->isValid()){
            $dadosPessoa['img'] = $request->img->store('fotos_pessoas');
        } 
        $dadosPessoa->update($request->all());
        $user = User::find($request->user_id);
        $user->profile_complete = true;
        $user->save();
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

    public function fornecedores(Request $request){

        $this->authorize('ver-fornecedor');
        $query = $this->repository->newQuery();
        // Adicione a condição fixa para tipo_usuario = 'E'
        $query->whereHas('usuario', function($q) {
            $q->where('tipo_usuario', 'E');
        });

        // Coletar parâmetros de pesquisa
        $search = $request->input('pesquisa');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nome_fantasia', 'LIKE', "%{$search}%")
                ->orWhere('razao_social', 'LIKE', "%{$search}%")
                ->orWhere('cnpj', 'LIKE', "%{$search}%")
                ->orWhereHas('usuario', function($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                });
            });
        }

        $fornecedores = $query->paginate(10);  
        return view('admin.pages.fornecedores.index', compact('fornecedores'));
   
    }

    public function fornecedorShow($id)
    {
        $this->authorize('ver-fornecedor');
        $fornecedor = $this->repository->findOrFail($id);
        return view('admin.pages.fornecedores.show', compact('fornecedor'));
    }
}
