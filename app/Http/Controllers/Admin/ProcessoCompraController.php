<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProcessoCompras;
use App\Http\Requests\StoreUpdateProposition;
use App\Models\AnexosProcessoCompra;
use App\Models\CredenciamentosProcessosCompras;
use App\Models\CriterioJulgamento;
use App\Models\Modalidades;
use App\Models\ProceedingSituation;
use App\Models\ProcessoCompras;
use App\Models\TiposMovimentacoesCredenciamentos;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $repository, $modalidade, $criteriosJulgamento, $situacao, $type_document;

    public function __construct(
        ProcessoCompras $repository,
        Modalidades $modalidade,
        CriterioJulgamento $criterioJulgamento,
        ProceedingSituation $situacao,
        TypeDocument $type_document
    ) {
        $this->repository = $repository;
        $this->modalidade = $modalidade;
        $this->criteriosJulgamento = $criterioJulgamento;
        $this->situacao = $situacao;
        $this->type_document = $type_document;
    }

    public function index( Request $request )
    {
        if (!Gate::any(['ver-processos-usuario-externo', 'ver-processo-compras'])) {
            abort(403, 'Ação não autorizada.');
        }
        // Obter o usuário logado
        $user = auth()->user();
        $dado_pessoa_id = $user->dadosPessoais->id;        
        $modalidades = $this->modalidade->get();
        $criteriosJulgamento = $this->criteriosJulgamento->get();
        $situacoes = $this->situacao->where('processo_compra', true)->get();

        // Filtrar os processos por modalidade e situacao
        $filters = $request->only('modalidade_id', 'criterio_julgamento_id', 'proceeding_situation_id', 'pesquisa');
        // Inicializar um array para armazenar os dados
         $processos = ProcessoCompras::with(['credenciamentos' => function($query) use ($dado_pessoa_id) {
            $query->where('dado_pessoa_id', $dado_pessoa_id)
                  ->with('ultimaMovimentacao');
        }])

        ->filter($filters)
        ->orderBy('data_publicacao', 'desc')
        ->paginate(10);

        $processosData = $processos->map(function ($processo) use ($dado_pessoa_id) {
            $credenciamento = CredenciamentosProcessosCompras::getCredenciamento($dado_pessoa_id, $processo->id);            
            $ultimaMovimentacao = CredenciamentosProcessosCompras::ultimaMovimentacaoCredenciado($processo->id, $dado_pessoa_id);
            return [
                'processo' => $processo,
                'credenciamento_id' => $credenciamento ? $credenciamento->id : null,
                'ultima_movimentacao' => $ultimaMovimentacao
            ];
        });

          // Converter a coleção mapeada em um LengthAwarePaginator
        $paginatedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $processosData,
            $processos->total(),
            $processos->perPage(),
            $processos->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.pages.processos.index', compact('paginatedData', 'modalidades', 'criteriosJulgamento', 'situacoes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('novo-processo-compras');

        $modalidades = $this->modalidade->get();
        $criteriosJulgamento = $this->criteriosJulgamento->get();
        $situacoes = $this->situacao->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
        return view('admin.pages.processos.create', compact('modalidades', 'criteriosJulgamento', 'situacoes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateProcessoCompras $request)
    {
       
        $this->authorize('novo-processo-compras');
        $dados = $request->all();
        $dados['user_created'] = auth()->user()->id;
        $dados['data_publicacao'] = date('Y/m/d H:i:s');

        //dd($dados);
        $this->repository->create($dados);

        toast('Cadastro realizado com sucesso!', 'success')->toToast('top');
        return redirect()->route('processos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       // $this->authorize('ver-processo-compras');

        if (!Gate::any(['ver-processos-usuario-externo', 'ver-processo-compras'])) {
            abort(403, 'Ação não autorizada.');
        }

        $processo = $this->repository->where('id', $id)->first();

        if (!$processo)
            return redirect()->back();

        return view('admin.pages.processos.show', [
            'processo' => $processo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('editar-processo-compras');
        $processo = $this->repository->where('id', $id)->first();
        // Formatar data usando Carbon

        $dataFormatada = $processo->inicio_sessao->format('Y-m-d'); // Altere o formato conforme necessário       
        // Adicionar data formatada ao objeto $processo
        $processo->data_formatada = $dataFormatada;

        $modalidades = $this->modalidade->get();
        $criteriosJulgamento = $this->criteriosJulgamento->get();
        $situacoes = $this->situacao->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo

        if (!$processo) {
            return redirect()->back();
        }
        return view('admin.pages.processos.edit', [
            'processo' => $processo,
            'modalidades' => $modalidades,
            'criteriosJulgamento' => $criteriosJulgamento,
            'situacoes' => $situacoes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateProcessoCompras $request, string $id)
    {
        $this->authorize('editar-processo-compras');
        $processo = $this->repository->where('id', $id)->first();

        if (!$processo) {
            redirect()->back();
        }

        $dadosProcesso = $request->all();
        $dadosProcesso['user_last_updated'] = auth()->user()->id;

        $processo->update($dadosProcesso);

        toast('Cadastro atualizado com sucesso!', 'success')->toToast('top');
        return redirect()->route('processos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {       
        if (!Gate::any(['excluir-processo-compras'])) {
            abort(403, 'Ação não autorizada.');
        };

        $processo = $this->repository->findOrFail($id);        
        if (!$processo) {
            return redirect()->back();
        }   
        // Verificar se há credenciamentos associados a este processo
        $temCredenciamento = CredenciamentosProcessosCompras::where('processo_compra_id', $processo->id)->exists();
        if ($temCredenciamento) {
            toast('Não é possível excluir o processo, pois existem credenciamentos associados.', 'error')->toToast('top');
            return redirect()->back();
        }       
        foreach ($processo->anexos as $anexo) {
            if (Storage::disk('s3')->exists($anexo->anexo)) {
                Storage::disk('s3')->delete($anexo->anexo);
            }
            $anexo->delete();
        } 
        $processo->delete();      

        toast('Processo excluido com sucesso!', 'success')->toToast('top');
        return redirect()->route('processos.index');

    }

    public function createAttachment($id)
    {
        $this->authorize('editar-processo-compras');
        $processo = $this->repository->where('id', $id)->first();
        $type_documents = $this->type_document->where('processo_compra', true)->get(); // pega somente os que pertece a esse modulo
        if (!$processo) {
            return redirect()->back();
        }
        return view('admin.pages.processos.attachment.create', [
            'processo' => $processo,
            'type_documents' => $type_documents,
        ]);
    }

    public function storeAttachment(Request $request)
    {
        $this->authorize('editar-processo-compras');
        $anexo = new AnexosProcessoCompra();

        $anexoProcesso = $request->only('processo_compra_id', 'type_document_id', 'descricao', 'anexo');
        $anexoProcesso['user_id'] = auth()->user()->id;

        if ($request->hasFile('anexo')) {
            $anexoProcesso['nome'] = Str::upper($anexoProcesso['anexo']->getClientOriginalName());
            $anexoProcesso['anexo'] = $request->anexo->store('anexos_processo_compra');
        }
        $anexo->create($anexoProcesso);
        toast('Cadastro realizado com sucesso!', 'success')->toToast('top');
        return redirect()->back();
    }
    public function deleteAttachment($id)
    {
        $this->authorize('excluir-processo-compras');
        //Recupera a anexo pelo id
        $anexo = AnexosProcessoCompra::find($id);
        // Verifica se a quantidade de downloads é maior que 0
        if ($anexo->qtd_download > 0) {
            // Retorna uma mensagem de erro e não permite a exclusão
        return redirect()->back()->with('error', 'Não é possível excluir o anexo porque ele já foi baixado.');
        }
        //Verifica se pelo nome, se ela existe no storage, e deleta do storage
        if (Storage::disk('s3')->exists($anexo->anexo)) {
            Storage::disk('s3')->delete($anexo->anexo);
        }
        //deleta a referência do banco
        $anexo->delete();
        toast('Anexo  removido com sucesso!', 'success')->toToast('top');
        return redirect()->back();
    }

    public function download($id)
    {
        // Recupera o anexo pelo id
        $anexo = AnexosProcessoCompra::find($id);
        if ($anexo) {
            $anexo->qtd_download++;
            $anexo->save();
            // Redireciona para o arquivo PDF
            $fileUrl = config('app.aws_url') . $anexo->anexo;
            return redirect($fileUrl);
        } else {
            return abort(404, 'Anexo não encontrado.');
        }
    }

    public function verCrendenciados($id){
        if (!Gate::any(['ver-processo-compras'])) {
            abort(403, 'Ação não autorizada.');
        }
        $processo = $this->repository::with('credenciamentos.movimentacoes')->findOrFail($id);   
        $tiposMovimentacoes = TiposMovimentacoesCredenciamentos::all();
        if (!$processo) {   
            return redirect()->back();
        }

         // Obter as contagens
        $counts = $processo->countCredenciamentosWithLastMovements();
        
        // Inicializar um array para armazenar os dados dos credenciados e suas últimas movimentações
        $credenciadosData = [];

        foreach ($processo->credenciamentos as $credenciado) {
            $ultimaMovimentacao = CredenciamentosProcessosCompras::ultimaMovimentacaoCredenciado($processo->id, $credenciado->dado_pessoa_id);

            $credenciadosData[] = [
                'credenciado' => $credenciado,
                'ultima_movimentacao' => $ultimaMovimentacao
            ];
        }        
        // Ordenar os credenciados por última movimentação em ordem decrescente
            usort($credenciadosData, function ($a, $b) {
                if ($a['ultima_movimentacao'] && $b['ultima_movimentacao']) {
                    return strtotime($b['ultima_movimentacao']->created_at) - strtotime($a['ultima_movimentacao']->created_at);
                } elseif ($a['ultima_movimentacao']) {
                    return -1;
                } elseif ($b['ultima_movimentacao']) {
                    return 1;
                } else {
                    return 0;
                }
            });
        return view('admin.pages.processos.credenciamento.credenciados', 
        compact('processo', 'credenciadosData', 'tiposMovimentacoes', 'counts'));

    }
}
