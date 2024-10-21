<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Functions;
use App\Models\User;
use App\Models\UserFunction;
use Illuminate\Http\Request;

class UserFunctionController extends Controller
{
    private $repository, $function, $user;

    public function __construct(UserFunction $userFunctions, Functions $function, User $user){        
        $this->repository = $userFunctions;
        $this->function = $function;
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('ver-funcoes');
        $pesquisa = $request->input('pesquisa');
        // Consulta básica de UsersFunction
        $query = $this->repository::with(['user', 'function']);
        // Se houver valor de pesquisa, aplica o filtro
        if($pesquisa){
            $query->whereHas('user', function($q) use ($pesquisa) {
                $q->where('name', 'like', '%' . $pesquisa . '%');
            })->orWhereHas('function', function($q) use ($pesquisa) {
                $q->where('nome', 'like', '%' . $pesquisa . '%');
            });
        }
        $usersFunctions = $query->paginate(10);
        return view('admin.pages.userFunctions.index', compact('usersFunctions', 'pesquisa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('nova-funcoes');
        $functions = $this->function->get();       
        $users = $this->user->get();
        return view('admin.pages.userFunctions.create', compact('functions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('nova-funcoes');            
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'function_id' => 'required|exists:functions,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
            'legislacao' => 'nullable|string|max:45',
            'situacao' => 'nullable|integer'
        ]);

        // Verificação se a função já está em aberto para o mesmo usuário
        $existingFunction = $this->repository::where('user_id', $validatedData['user_id'])
        ->where('function_id', $validatedData['function_id'])
        ->where(function($query) {
            // Verifica se a data de término é maior ou igual à data atual OU se não tem data de fim
            $query->where('data_fim', '>=', now()->format('Y-m-d'))
                ->orWhereNull('data_fim');
        })
        ->where('situacao', 1) // Verifica se a situação está ativa (1)
        ->first();

        // Se já existir uma função em aberto, impede a criação e retorna uma mensagem de erro
        if ($existingFunction) {
            toast('Este usuário já possui esta função em aberto.','error')->toToast('top') ;
            return redirect()->back();
            //return redirect()->back()->withErrors(['error' => 'Este usuário já possui esta função em aberto.']);
        }

        // Define a situação como "Ativo" (1) por padrão, se não for informada
        if (!isset($validatedData['situacao'])) {
            $validatedData['situacao'] = 1; // Ativo
        }
        // Cria uma nova associação de função com o usuário
        $this->repository::create($validatedData);
        // Redireciona o usuário para a página de listagem com uma mensagem de sucesso
        toast('Cadastro realizado com sucesso!','success')->toToast('top') ;     
        return redirect()->route('userFunctions.index');
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
        $this->authorize('editar-funcoes');             
        $users = $this->user->get();
        $functions = $this->function->get();
        $userFunction =$this->repository->where('id', $id)->first();
        return view('admin.pages.userFunctions.edit', compact('userFunction', 'users','functions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('editar-funcoes');
        // Validação dos dados enviados pelo formulário
        $validatedData = $request->validate([
            'function_id' => 'required|exists:functions,id',
            'data_inicio' => 'required|date',
            'data_fim' => 'nullable|date',
            'legislacao' => 'nullable|string|max:45',
            'situacao' => 'nullable|integer'
        ]);
        // Localiza o registro de UsersFunction pelo ID
        $usersFunction = $this->repository::findOrFail($id);
        // Verifica se a situação foi inativada (situacao == 0) e se a data_fim não foi informada
        if ($validatedData['situacao'] == 0 && empty($validatedData['data_fim'])) {
            // Define a data atual como a data_fim
            $validatedData['data_fim'] = now()->format('Y-m-d');
        }

        // Atualiza o registro com os dados validados
        $usersFunction->update($validatedData);
        toast('Função atualizada com sucesso!','success')->toToast('top') ;
        return redirect()->route('userFunctions.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('excluir-funcoes');
        // Localiza o registro de UsersFunction pelo ID
        $usersFunction = $this->repository::findOrFail($id);

        // Verifica se a situação do registro é inativa (situacao == 0)
        if ($usersFunction->situacao == 0) {
            // Redireciona com uma mensagem de erro, impedindo a exclusão
            toast('Não é possível excluir registros inativos.','error')->toToast('top') ;
            return redirect()->back();
        }
        // Deleta o registro
        $usersFunction->delete();

        // Redireciona para a listagem com uma mensagem de sucesso
        toast('Função excluida com sucesso!','success')->toToast('top');            
        return redirect()->route('userFunctions.index');
    }
}
