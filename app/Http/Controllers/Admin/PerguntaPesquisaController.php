<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AlternativasPesquisa;
use App\Models\PerguntasPesquisa;
use App\Models\Questionario;
use Illuminate\Http\Request;

class PerguntaPesquisaController extends Controller
{
   
    public function index()
{
    $this->authorize('ver-pesquisa');
    // Busca os questionários com paginação
    $pesquisas = Questionario::orderBy('created_at', 'desc')->paginate(10);

    // Retorna a view com os dados
    return view('admin.pages.pesquisas.index', compact('pesquisas'));
}   


    public function perguntas($questionarioId)
    {
    
        $this->authorize('ver-pesquisa');
        // Carrega o questionário para exibir na view, se necessário
        $questionario = Questionario::findOrFail($questionarioId);

        // Filtra apenas perguntas vinculadas ao questionário selecionado
        $perguntas = PerguntasPesquisa::with('questionario')
                        ->where('questionario_id', $questionarioId)
                        
                        ->orderBy('numero', 'asc')
                        ->paginate(10);
        return view('admin.pages.pesquisas.perguntas', compact('perguntas', 'questionario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($questionario_id)
    {
        $this->authorize('nova-pesquisa');
        
        return view('admin.pages.pesquisas.create', compact('questionario_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('nova-pesquisa');

       
        
        $request->validate([
            'questionario_id' => 'required|exists:questionarios,id',
            'numero' => 'required|numeric',
            'pergunta' => 'required|string|max:255',
            'alternativas' => 'required|array|min:1',
            'alternativas.*' => 'required|string|max:255',
        ]);
        // Cria a pergunta
        $pergunta = PerguntasPesquisa::create([
            'questionario_id' => $request->questionario_id,
            'numero' => $request->numero,
            'pergunta' => $request->pergunta,
        ]);
        
    
        //dd($pergunta->id);
        // Cria as alternativas
        foreach ($request->alternativas as $textoAlternativa) {
            AlternativasPesquisa::create([
                'pergunta_pesquisa_id' => $pergunta->id,
                'alternativa' => $textoAlternativa,
            ]);
        }
        toast('Pergunta e alternativas cadastradas com sucesso','success')->toToast('top') ;
        return redirect()
            ->route('perguntas.index',  $request->questionario_id);
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
        $pergunta = PerguntasPesquisa::with('alternativas', 'respostas')->findOrFail($id);

        $alternativas = $pergunta->alternativas;
        $questionario_id = $pergunta->questionario_id;
        $temRespostas = $pergunta->respostas()->exists();

        return view('admin.pages.pesquisas.edit', compact('pergunta', 'temRespostas', 'alternativas','questionario_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pergunta = PerguntasPesquisa::with('respostas')->findOrFail($id);

        if ($pergunta->respostas()->exists()) {
            return redirect()->back()->with('error', 'Esta pergunta já possui respostas e não pode ser editada.');
        }

        // Se não houver respostas, permitir atualizar normalmente
        $pergunta->update([
            'numero' => $request->numero,
            'pergunta' => $request->pergunta,
        ]);

        $pergunta->alternativas()->delete();

        foreach ($request->alternativas as $alt) {
            $pergunta->alternativas()->create(['alternativa' => $alt]);
        }

        toast('Pergunta atualizada com sucesso','success')->toToast('top') ;
        return redirect()->route('perguntas.index', $request->questionario_id);
        //->with('success', 'Pergunta atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pergunta = PerguntasPesquisa::with('alternativas', 'respostas')->findOrFail($id);

        // Valida se já existem respostas vinculadas
        if ($pergunta->respostas()->exists()) {
            return redirect()->back()->with('error', 'Esta pergunta já possui respostas e não pode ser excluída.');
        }

        // Remove as alternativas associadas
        $pergunta->alternativas()->delete();

        // Remove a pergunta
        $pergunta->delete();
        toast('Pergunta excluída com sucesso','success')->toToast('top') ;
        return redirect()->back();
            // ->with('success', 'Pergunta excluída com sucesso.');
        }
}
