@extends('public_templates.leg.default')

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Pronunciamentos</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('pronunciamentos')}}</div>
        </div>
    </div>
</div>
   <div class="container">
        @include('public_templates.leg.includes.pronunciamentos.form_pesquisa')       
        {{-- Resultados --}}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Vereador</th>
                    <th>Sessão</th> 
                    <th>Legislatura</th>
                    <th>Pronúnciamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pronunciamentos as $pronunciamento)
                    <tr>
                        <td>{{ $pronunciamento->councilor->nome }}</td>                    
                        <td>{{ $pronunciamento->session->nome }} - {{ \Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($pronunciamento->session->hora)->format('H:i') }}</td>
                        <td>{{ $pronunciamento->session->legislature->descricao ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($pronunciamento->discurso), 100) }}</td>

                        <td class="text-center">
                            <a href="{{ route('camara.pronunciamento.show', $pronunciamento->id) }}" class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">
                                Ver Detalhes
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum pronunciamento encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $pronunciamentos->appends(request()->query())->links() }}
        

    </div>

@endsection