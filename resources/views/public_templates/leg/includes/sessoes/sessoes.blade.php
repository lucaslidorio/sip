@extends('public_templates.leg.default')

@section('content')

<div class="container">
    <h2 class="mb-4">Sessões Plenárias</h2>
    @include('public_templates.leg.includes.sessoes.form_pesquisa') 
    
    <!-- Tabela de Proposituras -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data / Hora</th>   
                <th>Tipo</th>
                <th>Legislatura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sessoes as $sessao)
                <tr>
                    <td>{{ $sessao->nome }}</td>                    
                    <td>{{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($sessao->hora)->format('H:i') }}</td>
                    <td>{{ $sessao->tipo->nome ?? '-' }}</td>
                    <td>{{ $sessao->legislatura->descricao ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('camara.sessao.show', $sessao->id) }}" class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">
                            Ver Detalhes
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhuma sessão encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginação -->
    {{ $sessoes->appends(request()->query())->links() }}
</div>

    <!-- Paginação -->
    



</div>
</div> 


@endsection