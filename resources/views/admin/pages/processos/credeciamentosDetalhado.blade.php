@extends('adminlte::page')

@section('title', "Ata")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1> Relatório detalhado</h1> - <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
        <li class="breadcrumb-item ">Relatório de credenciamento detalhado</li>
      </ol>
    </div>
  </div>
</div>
@include('sweetalert::alert')
@stop
@section('content')
<div class="card mb-3 mt-3 border " id="printable-card">
  <div class="row no-gutters border-botto pt-2  " >
    <div class="col-md-12 text-right pr-3 mt-0 d-print-none">
      <button onclick="gerarPdfCard()" type="button " class="btn btn-default "
      data-toggle="tooltip" data-placement="top" title="Baixar em PDF">
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
    <div class="col-md-3 mb-0" style="padding-left: 15px">
      <p class="card-text mb-0"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>      
      <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>
      <td>
    </div>
    <div class="col-md-3" style="padding-left: 15px">
      <p class="card-text mb-0"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d/m/Y')}} </p>
      <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

    </div>
    <div class="col-md-3" style="padding-left: 15px">
      <p class="card-text mb-0"><strong>Válido até : </strong> {{$processo->data_validade->format('d/m/Y')}}</p>
      
      <p class="card-text"><strong>Situação : </strong>  
        {{$processo->situacao->nome}} </p>
    </div>
    <div class="col-md-3" style="padding-left: 15px">
      <p class="card-text mb-0"><strong>Modalidade: </strong>
        {{\Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
    </div>
    <div class="col-md-12" style="padding-left: 15px">    
        <p class="card-text text-justify"><strong>Descricao:</strong> <br> {{$processo->descricao}}</p>            
    </div>
  </div>
  <div class="row mr-3 ml-3">
  <div class="col-md-12 "> 
    <table class="table table-bordered">
        @foreach($credenciados as $credenciado)
        <thead>
            <tr>
                <th scope="col">Razão Social / Nome Fantasia: </th>
                <th scope="col">CNPJ: </th>
                <th scope="col">Enquadramento:</th>
                <th scope="col">Situação Atual:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $credenciado->dadoPessoa->razao_social }} ({{ $credenciado->dadoPessoa->nome_fantasia }})</td>
                <td>{{ $credenciado->dadoPessoa->cnpj }}</td>
                <td>{{ $credenciado->dadoPessoa->enquadramento }}</td>
                <td>{{$credenciado->situacao_atual}}</td>
            </tr>
            <tr>
                <td colspan="4">
                  <strong>Movimentações do credenciamento:</strong><br>
                    @foreach($credenciado->movimentacoes as $movimentacao)
                      @if($movimentacao->user->tipo_usuario === 'I')
                        <strong class="text-uppercase">{{ $movimentacao->user->name }}</strong> , Mat. {{ $movimentacao->user->matricula }} efetuou uma ação:
                        <strong>{{ $movimentacao->tipoMovimentacao->nome }}</strong> para o fornecedor
                        <small>em {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i:s') }}.</small> <br>
                        <small>
                          @if(!empty($movimentacao->observacao))
                          Nota: {{ $movimentacao->observacao}}<br>
                        @endif
                        </small>

                      @else
                        O Fornecedor efetuou uma ação: <strong>{{ $movimentacao->tipoMovimentacao->nome }}</strong>
                        <small>em {{ \Carbon\Carbon::parse($movimentacao->created_at)->format('d/m/Y H:i:s') }}.</small> <br>
                      @endif
                    @endforeach
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    
  </div>
</div>
  <div class="card-footer  border-top bg-transparent" >
    <div class="row">      
      <div class="col-md-12">
        <div class="text-center">
          <small>Documento gerado em {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }} 
            pelo sistema Podium, licenciado para {{$tenant->nome}} </small><br>  
            <small>{{$tenant->endereco}}, {{$tenant->numero}}, {{$tenant->bairro}} - {{$tenant->cidade}} - CEP: {{$tenant->cep}}</small> 
            <br>
             <small >Telefone: {{$tenant->telefone}}</small> <br>
             <small >E-mail: {{$tenant->email}}</small>        
        </div>
      </div>
    </div>
  </div>
</div>

@section('js')
<script>
  //inicia o tooltip
  $(function () {
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



</script>

@endsection

@stop