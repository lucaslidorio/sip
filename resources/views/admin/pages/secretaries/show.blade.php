@extends('adminlte::page')

@section('title', "Detalhe da secretaria")

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  secretaria -  <strong>{{$secretary->nome}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('secretaries.index')}}">Secretarias</a></li>
          <li class="breadcrumb-item active">Detalhes</li>          
        </ol>
      </div>
    </div>
</div>
@include('sweetalert::alert')
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Coluna da Imagem -->
            <div class="col-md-3 text-center mb-4">
                @if($secretary->img_secretario)
                    <img src="{{config('app.aws_url').$secretary->img_secretario }}" 
                         alt="Foto do Secretário" 
                         class="img-fluid rounded"
                         style="max-height: 300px;">
                @else
                    <img src="{{config('app.aws_url').'uteis/no-image.jpg'}}" 
                         alt="Sem foto" 
                         class="img-fluid rounded">
                @endif
            </div>

            <!-- Coluna das Informações -->
            <div class="col-md-9">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <strong>Nome:</strong> {{$secretary->nome}}
                    </li>
                    <li class="mb-3">
                        <strong>Sigla:</strong> {{$secretary->sigla}}
                    </li>    
                    <li class="mb-3">
                        <strong>Responsável:</strong> {{$secretary->nome_responsavel}}
                    </li>
                    <li class="mb-3">
                        <strong>Telefone:</strong> {{$secretary->telefone}}
                    </li>
                    <li class="mb-3">
                        <strong>Celular:</strong> {{$secretary->celular}}
                    </li>
                    <li class="mb-3">
                        <strong>Endereço:</strong> {{$secretary->endereco}}
                    </li>
                    <li class="mb-3">
                        <strong>E-mail:</strong> {{$secretary->email}}
                    </li>          
                    <li class="mb-3">
                        <strong>Situação:</strong> 
                        <span class="badge badge-{{ $secretary->situacao == 1 ? 'success' : 'danger' }}">
                            {{$secretary->situacao == 1 ? 'Ativo' : 'Inativo'}}
                        </span>
                    </li>
                    <li class="mb-3">
                        <strong>Slogan:</strong> {{ $secretary->slogan ?? '-' }}
                    </li>
                    <li class="mb-3">
                        <strong>Ícone:</strong>
                        @if(!empty($secretary->icone))
                            <i class="{{ $secretary->icone }}"></i>
                            <small class="text-muted ml-2">{{ $secretary->icone }}</small>
                        @else
                            -
                        @endif
                    </li>
                    <li class="mb-3">
                        <strong>Cor de Destaque:</strong>
                        @if(!empty($secretary->cor_destaque))
                            <span style="display:inline-block;width:18px;height:18px;border-radius:4px;vertical-align:middle;background: {{ $secretary->cor_destaque }}; border:1px solid #ddd;"></span>
                            <small class="ml-1">{{ $secretary->cor_destaque }}</small>
                        @else
                            -
                        @endif
                    </li>
                </ul>
            </div>

            <!-- Sobre a Secretaria -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Sobre a Secretaria</h5>
                    </div>
                    <div class="card-body">
                        {!! $secretary->sobre ?? 'Nenhuma informação disponível.' !!}
                    </div>
                </div>
            </div>

            <!-- Sobre o Secretário -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Sobre o Secretário</h5>
                    </div>
                    <div class="card-body">
                        {{ $secretary->sobre_secretario ?? 'Nenhuma informação disponível.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 text-center" >
        <div class="form-group">
             <a href="{{route('secretaries.edit', $secretary->id)}}" class="btn btn-primary btn-lg ">Editar</a>
        </div>   
    </div>
    <div class="card">
       
    </div>
</div>
@stop

@section('css')
<style>
    .list-unstyled li {
        border-bottom: 1px solid #eee;
        padding-bottom: 0.5rem;
    }
    .list-unstyled li:last-child {
        border-bottom: none;
    }
</style>
@stop
