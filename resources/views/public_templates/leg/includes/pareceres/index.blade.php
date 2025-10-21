@extends('public_templates.leg.default')

@section('content')
<div class="row border-top " style="height: 60px; background-color: #f5f5f5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-7">
                <p class="fs-1">Pareceres das Comissões</p>
            </div>
            <div class="col-5 fs-4">{{ Breadcrumbs::render('pareceres') }}</div>
        </div>
    </div>
</div>

<div class="container mt-2 ">
    <!-- Formulário de Filtro -->
   @include('public_templates.leg.includes.pareceres.form_pesquisa')

    <!-- Tabela de pareceres -->
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Data</th>
                <th>Comissão</th>
                <th>Propositura</th>
                <th>Assunto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pareceres as $parecer)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($parecer->data)->format('d/m/Y') }}</td>
                    <td>{{ $parecer->commission->nome ?? '-' }}</td>
                    <td>{{ $parecer->proposition->tipo->nome ?? '-' }} Nº {{ $parecer->proposition->numero ?? '' }}</td>
                    <td>{{ $parecer->assunto }}</td>
                    <td class="text-center">
                        <a href="{{ route('camara.parecer.show', $parecer->id) }}" class="btn btn-primary cor-padrao-bg text-white btn-sm fs-4">
                            Ver Parecer
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum parecer encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Paginação -->
    {{ $pareceres->appends(request()->query())->links() }}
</div>
@endsection
