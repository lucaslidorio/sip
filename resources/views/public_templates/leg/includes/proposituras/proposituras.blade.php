@extends('public_templates.leg.default')

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Proposituras</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('proposituras')}}</div>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="mb-4"></h2>
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
                        <a href="{{ route('camara.propositura.show', $propositura->id) }}" class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">
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