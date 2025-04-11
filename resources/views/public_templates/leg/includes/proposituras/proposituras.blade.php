@extends('public_templates.leg.default')

@section('content')

<div class="container">
    <h2 class="mb-4">Proposituras</h2>
    @include('public_templates.leg.includes.proposituras.form_pesquisa') 
    
    <!-- Tabela de Proposituras -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Número</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proposituras as $propositura)
                <tr>
                    <td>{{ $propositura->numero }}</td>
                    <td>{{ \Carbon\Carbon::parse($propositura->data)->format('d/m/Y') }}</td>
                    <td>{{ $propositura->tipo->nome }}</td>
                    <td>{!! Str::limit($propositura->descricao, 50) !!}</td>
                    <td>{{ $propositura->situacao->nome }}</td>
                    <td class="text-center">
                        <a href="{{ route('camara.propositura.show', $propositura->slug) }}" class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">
                            Ver Detalhes
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma propositura encontrada.</td>
                </tr>
            @endforelse
        </tbody>
        
    </table>
    <!-- Paginação -->
    {{ $proposituras->appends(request()->query())->links() }}
</div>


</div>
</div> 


@endsection