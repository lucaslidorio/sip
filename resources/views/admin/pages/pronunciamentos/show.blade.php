@extends('adminlte::page')
@section('title', "Visualizar Pronunciamento")
@section('content_header')
@section('plugins.Select2', false)
@section('plugins.Summernote', false)
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Visualizar Pronunciamento do Vereador <strong> {{$pronunciamento->councilor->nome}}</strong>  na <strong>{{$pronunciamento->session->nome}}</strong> </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('pronunciamentos.index')}}">Pronunciamentos </a></li>
          <li class="breadcrumb-item ">Visualizar a Pronunciamento</li>          
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
            {{-- Foto do vereador --}}
            <div class="col-md-2 text-center">
              <img src="{{config('app.aws_url').$pronunciamento->councilor->img }}" class="card-img rounded" alt="" 
              style="max-width: 240px; margim:10px;" >
                <div class="fw-bold mt-2">{{ $pronunciamento->councilor->nome }}</div>
            </div>

            {{-- Dados principais --}}
            <div class="col-md-10">
                <dl class="row">
                    <dt class="col-sm-3">Sessão:</dt>
                    <dd class="col-sm-9">
                        Sessão {{ $pronunciamento->session->numero ?? '-' }} -
                        {{ \Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y') }}
                    </dd>

                    <dt class="col-sm-3">Discurso:</dt>
                    <dd class="col-sm-9">
                        {!!$pronunciamento->discurso ?: '<em>Não informado</em>' !!}
                    </dd>

                    @if($pronunciamento->link_video)
                        <dt class="col-sm-3">Vídeo:</dt>
                        <dd class="col-sm-9">
                            <a href="{{ $pronunciamento->link_video }}" target="_blank">
                                {{ $pronunciamento->link_video }}
                            </a>

                            <div class="mt-2">
                                <iframe width="50%" height="315" src="{{ embedVideo($pronunciamento->link_video) }}"
                                    frameborder="0" allowfullscreen></iframe>
                            </div>
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
    <div class="card-footer">
      <a class="btn btn-primary" href={{route('pronunciamentos.edit', ['id'=>$pronunciamento->id])}} role="button" data-toggle="tooltip" 
        data-placement="top" title="Editar pronunciamento">
        <i class="fas fa-edit" ></i> Editar</a>
    </div>
</div>

@stop
