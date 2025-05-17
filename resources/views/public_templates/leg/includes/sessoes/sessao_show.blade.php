@extends('public_templates.leg.default')

@section('content')
<style>
    .btn-transmissao {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background: #007bff;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        overflow: hidden;
        z-index: 1;
        transition: box-shadow 0.3s ease;
    }


    /* Brilho automático */
    .btn-transmissao::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: linear-gradient(120deg, rgba(255, 255, 255, 0.3) 0%, rgba(255, 255, 255, 0.6) 100%);
        transform: skewX(-25deg);
        animation: shine 2s infinite;
        z-index: 0;
    }

    /* Pausa o brilho no hover */
    .btn-transmissao:hover::before {
        animation-play-state: paused;
    }

    /* Remove efeitos padrão de hover e adiciona destaque */
    .btn-transmissao:hover {
        color: #fff;
        background: #0069d9;
        text-decoration: none;
        transition: 0.1s ease;
        box-shadow: 0 0 20px rgba(0, 123, 255, 0.6);
    }

    @keyframes shine {
        0% {
            left: -75%;
        }

        100% {
            left: 125%;
        }
    }

    .btn-transmissao {
        position: relative;
        z-index: 1;
    }

    .btn-transmissao span {
        position: relative;
        z-index: 2;
    }
</style>
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Detalhes da <strong>{{ $sessao->nome }} Sessão</strong> {{ $sessao->tipo->nome ?? '-' }}</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('sessao', $sessao)}}</div>
        </div>
    </div>
</div>
<div class="container mt-3">   
    @include('public_templates.leg.includes.sessoes.form_pesquisa')
    <!-- Tabela de Sessão -->
    <h3 class="mb-4">
        Dados da Sessão
    </h3>
    <!-- Dados da Sessão -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <!-- Coluna 1 -->
                <div class="col-md-6">
                    <p><strong>Nome:</strong> {{ $sessao->nome }}</p>
                    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }}</p>
                    <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($sessao->hora)->format('H:i') }}</p>
                    <p><strong>Tipo:</strong> {{ $sessao->tipo->nome ?? '-' }}</p>
                </div>

                <!-- Coluna 2 -->
                <div class="col-md-6">
                    <p><strong>Legislatura:</strong> {{ $sessao->legislatura->descricao ?? '-' }}</p>
                    <p><strong>Seção Legislativa:</strong> {{ $sessao->secao->descricao ?? '-' }}</p>
                    <p><strong>Período:</strong> {{ $sessao->periodo->nome ?? '-' }}</p>
                    @if($sessao->link_transmissao)
                    <p><strong>Transmissão:</strong></p>
                    <a href="{{ $sessao->link_transmissao }}" target="_blank" class="btn btn-transmissao fs-5">
                        Acessar link de transmissão
                    </a>
                    @endif
                </div>
            </div>

            <!-- Linha única para descrição -->
            <div class="row mt-3 ">
                <div class="col-12">
                    <p class="ms-3"><strong>Descrição:</strong> {!! nl2br(e($sessao->descricao)) !!}</p>
                </div>
            </div>
        </div>

        <!-- Anexos -->
        <div class="card mb-4">
            <div class="card-header cor-padrao-bg text-white">
                <h5 class="mb-0">Anexos</h5>
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($sessao->anexos as $anexo)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $anexo->typeDocument->nome ?? '-' }}</strong> - {{ $anexo->descricao ??
                        $anexo->nome_original }}
                    </span>
                    <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" target="_blank" class="btn btn-lg
                        btn-outline-primary">Visualizar</a>
                </li>
                @empty
                <li class="list-group-item text-muted">Nenhum anexo disponível.</li>
                @endforelse
            </ul>
        </div>
        <!-- Proposituras Votadas -->
        <div class="card mb-4">
            <div class="card-header cor-padrao-bg text-white">
                <h5 class="mb-0">Matérias Deliberadas</h5>
            </div>
            <div class="card-body p-0">
                @if($propositurasVotadas->isEmpty())
                <div class="p-3 text-muted">Nenhum projeto de lei foi votado nesta sessão.</div>
                @else
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Tipo</th>
                            <th>Descrição</th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($propositurasVotadas as $prop)
                        <tr>
                            <td>{{ $prop->numero }}</td>
                            <td>{{ $prop->tipo->nome ?? '-' }}</td>
                            <td>{!! Str::limit($prop->descricao, 100) !!}</td>
                            <td class="text-center">
                                <a href="{{ route('camara.propositura.show', $prop->id) }}"
                                    class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">Visualizar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
      @php
        use Carbon\Carbon;
        
        $dataSessao = Carbon::parse($sessao->data)->startOfDay();
        $hoje = Carbon::now()->startOfDay();
        
        $temPresencas = isset($presencas) && $presencas->isNotEmpty();
        
        $mostrarPresencas = $hoje->greaterThan($dataSessao) || $temPresencas;
        @endphp



        <div class="card-header cor-padrao-bg text-white">
            <h5 class="mb-0">Presença dos Vereadores</h5>
        </div>
        <div class="card-body p-0">
            @if($mostrarPresencas)
            <div class="card mb-4">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Vereador</th>
                            <th>Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presentes as $vereador)
                        <tr>
                            <td>{{ $vereador->nome }} <strong>({{$vereador->nome_parlamentar}})</strong></td>
                            <td>Presente <span class="text-success"><i class="fas fa-check"></i></span></td>
                        </tr>
                        @endforeach

                        @foreach ($faltaram as $vereador)
                        <tr>
                            <td>{{ $vereador->nome }} <strong>({{$vereador->nome_parlamentar}})</td>
                            <td>Faltou<span class="text-danger"> <i class="fas fa-times"></i></span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                {{-- Sessão futura, ainda não ocorreu --}}
                <div class="alert alert-warning m-2">
                    A sessão está agendada para o dia {{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }}
                     às {{ \Carbon\Carbon::parse($sessao->hora)->format('H:i') }}.<br>

                    Os dados de presença estarão disponíveis após a realização da sessão.
                </div>
                @endif
        </div>
    </div>


</div>



</div>





@endsection