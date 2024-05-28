@extends('adminlte::page')

@section('title', "Detelhes do Proceso")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  processo -  <strong>{{$processo->numero}}/ {{$processo->data_publicacao->year}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop

@section('content')


<div class="card mb-3 mt-3">
  <div class="row no-gutters " style="padding:15px">
       <div class="col-md-4" style="padding-left: 15px" >     
        <p class="card-text"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
        <p class="card-text"><strong>Modalidade: </strong>
          {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p> 
        <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>             
        <td>
    </div>
    <div class="col-md-4" style="padding-left: 15px">  
        <p class="card-text"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d-m-Y H:i:s')}}</p>
        <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>
    
    </div>
    <div class="col-md-4" style="padding-left: 15px">  
      <p class="card-text"><strong>Início da Sessão : </strong> {{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</p>
      <p class="card-text"><strong>Situação : </strong> {{$processo->situacao->nome}}</p>    
      
   </div>

   <div class="col-md-12" style="padding-left: 25px">  
    <div class="row border-top mt-3 ">
      <p class="card-text text-justify"><strong>Descricao:</strong> <br> {{$processo->descricao}}</p>
    </div>
    <div class="row border-top mt-3 ">
      <p class="card-text text-justify"><strong>Objeto:</strong> <br> {{$processo->objeto}}</p>
    </div>
 </div>
  </div>
   
  
    
  
  <div class="card-footer"style="padding-left: 34px" >
    <a class="btn btn-primary" href={{route('processos.edit', ['id'=>$processo->id])}} role="button" data-toggle="tooltip" 
    data-placement="top" title="Editar Processo">
    <i class="fas fa-edit" ></i> Editar</a>
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
