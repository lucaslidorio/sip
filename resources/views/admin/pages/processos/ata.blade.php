@extends('adminlte::page')

@section('title', "Ata")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Ata do Proceso - <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
                <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
                <li class="breadcrumb-item ">Ata</li>
            </ol>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@stop

@section('content')

<div class="card mb-3 mt-3 border " id="printable-card">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="row no-gutters border-botto pt-2  ">
        <div class="col-md-12 text-right pr-3 mt-0 d-print-none">
            <button onclick="gerarPdfCard()" type="button " class="btn btn-default " data-toggle="tooltip" data-placement="top" title="Baixar em PDF">
                <i class="far fa-file-pdf  text-danger"></i>
            </button>
        </div>
        <div class="col md-12 text-center">
            <img src="{{ config('app.aws_url')."{$tenant->brasao}" }}" class=" mx-auto d-block" alt="Brasão do município">
            <p class="mb-1">{{$tenant->nome}}</p>
            <p class="mb-1">{{$tenant->endereco}} {{$tenant->numero}}, {{$tenant->bairro}} </p>
            <p class="">{{$tenant->cnpj}}</p>
        </div>
    </div>
    <div class="row no-gutters justify-content-center pt-3">
        <h4 class="text-center">ATA DO PROCESSO DE CRENDÊNCIAMENTO Nº: {{$processo->numero}}/{{$processo->data_publicacao->year}}</h4>
    </div>

    <div class="row no-gutters  " style="padding:15px">
        <div class="col-md-3 col-print-3 mb-0" style="padding-left: 15px">
            <p class="card-text mb-0"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
            <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>
            <td>
        </div>
        <div class="col-md-3 col-print-3" style="padding-left: 15px">
            <p class="card-text mb-0"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d/m/Y')}} </p>
            <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

        </div>
        <div class="col-md-3 col-print-3" style="padding-left: 15px">
            <p class="card-text mb-0"><strong>Válido até : </strong> {{$processo->data_validade->format('d/m/Y')}}</p>

            <p class="card-text"><strong>Situação : </strong>
                {{$processo->situacao->nome}} </p>
        </div>
        <div class="col-md-3 col-print-3 " style="padding-left: 15px">
            <p class="card-text mb-0"><strong>Modalidade: </strong>
                {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
        </div>
        <div class="col-md-12  " style="padding-left: 15px">
            <p class="card-text text-justify"><strong>Descricao:</strong> <br> {{$processo->descricao}}</p>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row border-top  ">
            <ul class="mt-3 ml-2">
                @foreach($credenciamentos as $credenciamento)
                <li class=" {{ $loop->odd ? 'bg-light' : '' }} ">
                    @if($credenciamento->tipo_usuario === 'I')
                    <strong class="text-uppercase">{{ $credenciamento->usuario_responsavel }}</strong> , Mat. {{ $credenciamento->matricula }} efetuou uma ação:
                    <strong>{{ $credenciamento->tipo_movimentacao }}</strong> para o fornecedor:
                    <strong class="text-uppercase">{{$credenciamento->dado_pessoa_id}} - {{ $credenciamento->razao_social ?? '' }} ({{ $credenciamento->nome_fantasia ?? '' }}) {{$credenciamento->cnpj ?? ''}}</strong>
                    em {{ \Carbon\Carbon::parse($credenciamento->data_movimentacao)->format('d/m/Y H:i:s') }}. <br>
                    @if(!empty($credenciamento->observacao_movimentacao))
                    Nota: {{ $credenciamento->observacao_movimentacao }}
                    @endif
                    @else
                    O Fornecedor: <strong class="text-uppercase">{{$credenciamento->dado_pessoa_id}} - {{ $credenciamento->razao_social ?? '' }}
                        ({{ $credenciamento->nome_fantasia ?? '' }}) {{$credenciamento->cnpj ?? ''}}</strong>
                    efetuou uma ação: <strong> {{ $credenciamento->tipo_movimentacao }}</strong> <br>
                    <small>Ação realizada por: {{ $credenciamento->usuario_responsavel }} -
                        em: {{ \Carbon\Carbon::parse($credenciamento->data_movimentacao)->format('d/m/Y H:i:s') }}</small>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>


    <div class="card-footer  border-top bg-transparent">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <small>Documento gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
                        pelo sistema Podium, licenciado para {{$tenant->nome}} </small><br>
                    <small>{{$tenant->endereco}}, {{$tenant->numero}}, {{$tenant->bairro}} - {{$tenant->cidade}} - CEP: {{$tenant->cep}}</small>
                    <br>
                    <small>Telefone: {{$tenant->telefone}}</small> <br>
                    <small>E-mail: {{$tenant->email}}</small>
                </div>
            </div>


        </div>
    </div>
</div>

@section('js')
<script>
    //inicia o tooltip
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })

    function gerarPdfCard() {
        // Seleciona o conteúdo do card
        const cardContent = document.getElementById('printable-card').innerHTML;
        // Envia o HTML para o servidor usando fetch
        fetch('/admin/gerar-pdf', {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                    , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
                , body: JSON.stringify({
                    html: cardContent
                })
            })
            .then(response => {
                if (response.ok) {
                    return response.blob(); // Converte a resposta para um blob (arquivo binário)
                }
                throw new Error('Erro ao gerar PDF');
            })
            .then(blob => {
                // Cria uma URL para o PDF e abre em uma nova aba
                const url = window.URL.createObjectURL(blob);
                window.open(url, '_blank');
            })
            .catch(error => console.error(error));
    }





    //   function printCard() {
    //     // Seleciona o conteúdo do card
    //     const cardContent = document.getElementById('printable-card').innerHTML;

    //     // Abre uma nova janela
    //     const printWindow = window.open('', '', 'width=800,height=600');

    //     // Escreve o HTML do card dentro da nova janela
    //     printWindow.document.write(`
    //         <html>
    //             <head>
    //                 <title>Ata do Processo</title>
    //                 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    //                 <style>
    //                     /* Estilos adicionais para garantir a formatação */
    //                     body { margin: 0; padding: 10px; }
    //                 </style>
    //             </head>
    //             <body>${cardContent}</body>
    //         </html>
    //     `);

    //     // Fecha o documento para que a impressão funcione corretamente
    //     printWindow.document.close();

    //     // Aguarda o carregamento e chama o comando de impressão
    //     printWindow.onload = function() {
    //         printWindow.print();
    //         printWindow.close();
    //     };
    // }

</script>

@endsection

@stop
