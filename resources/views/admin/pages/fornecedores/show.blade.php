@extends('adminlte::page')

@section('title', "Detalhe do Parlamentar")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes do Fornecedor:  <strong>{{$fornecedor->razao_social}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('fornecedores.index')}}">Fornecedores </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>
@include('sweetalert::alert')
@stop
@section('content')
<div class="card mb-3 mt-3">
  <div class="row no-gutters " style="padding:20px">
    <div class="col-md-2">
      <img src="{{$fornecedor->usuario->profile_image_url}}" class="card-img rounded" alt="{{$fornecedor->titulo}}" 
      style="max-width: 240px; margim:10px;" >   
      <div class="shadow-sm p-3 mb-5 bg-body rounded p-1 mt-2">
        <h5 class="font-weight-normal">Dados de Acesso   </h5>
        <p class="card-text "><strong>Nome do usuário: </strong>{{$fornecedor->usuario->name}}</p>
        <p class="card-text "><strong> E-mail: </strong>{{$fornecedor->email}}</p>
        <p class="card-text "><strong> Tipo: </strong>{{$fornecedor->usuario->tipo_usuario_nome}}</p>
      </div>  
    </div>
    <div class="col-md-5" style="padding-left: 15px" >     
        <p class="ard-text "><strong> Razão Social: </strong>{{$fornecedor->razao_social}}</p>
        <p class="card-text"><strong>Nome Fanstasia: </strong> {{$fornecedor->nome_fantasia}}</p>
        <p class="card-text"><strong>CNPJ: </strong> {{$fornecedor->cpj}}</p>
        <p class="card-text"><strong>Insc. Est.: </strong> {{$fornecedor->inscricao_estadual}}</p>        
        <p class="card-text"><strong>Endereço: </strong> {{$fornecedor->endereco}}, {{$fornecedor->numero}}</p>
        <p class="card-text"><strong>Cidade: </strong> {{$fornecedor->cidade}} - {{$fornecedor->estado}}</p>
        <p class="card-text"><strong>Cidade: </strong> {{$fornecedor->email}}</p>
        <p class="card-text"><strong>Cidade: </strong> {{$fornecedor->site}}</p>       
        <td>
    </div>
    <div class="col-md-5" style="padding-left: 15px">  
        <p class="card-text"><strong>Tipo de Pessoa: </strong> {{$fornecedor->tipo_pessoa_nome}}</p>
        <p class="card-text"><strong>Natureza Juridica: </strong> {{$fornecedor->natureza_juridica_nome}}</p>
        <p class="card-text"><strong>Enquadramento: </strong> {{$fornecedor->enquadramento_nome}}</p>
        <p class="card-text"><strong>Data de Abertura: </strong>
          <td>{{\Carbon\Carbon::parse($fornecedor->data_abertura)->format('d/m/Y')}}</td>
        </p>
        <p class="card-text"><strong>Bairro: </strong> {{$fornecedor->bairro}}</p>
        <p class="card-text"><strong>Cep: </strong> {{$fornecedor->cep}}</p>
        <p class="card-text"><strong>Telefone: </strong> {{$fornecedor->telefone}}</p>
        <p class="card-text"><strong>Celular: </strong> {{$fornecedor->celular}}</p>  
    </div>     
  </div>
  <div class="card-footer">
  
  </div> 
</div>
<div class="card mt-3">
  <div class="card-header">
    <h5><i class="fas fa-folder "></i> Documentos</h5>
  </div>
  <div class="card-body">
    <div class="timeline-body">                       
      <div class="row">
        @foreach($fornecedor->documentosPessoas as $index => $documento)
            <div class="col-md-4 mb-4">
                <a href="{{ config('app.aws_url')."{$documento->anexo}" }}"
                   target="_blank" class="mb-2 text-reset"
                   data-toggle="tooltip" data-placement="top"
                   title="Clique para abrir o documento">
                   <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                   <span class="mr-2"> {{$documento->nome_original}}</span><br>                                     
                </a>                                  
            </div>
        @endforeach
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
 
</script>
    
@endsection
@stop
