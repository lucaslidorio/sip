@extends('adminlte::page')
@section('plugins.icheck-bootstrap', true)
@section('title', "Detalhes da propositura")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Detalhes da propositura - <strong>{{$proposition->numero}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('propositions.index')}}">Proposituras </a></li>
        <li class="breadcrumb-item ">Detalhes</li>
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
      <div class="col-sm-6">
        <p class="card-text"><strong>Numero: </strong> {{$proposition->numero}}</p>
        <p class="card-text"><strong>Data: </strong> {{\Carbon\Carbon::parse($proposition->data)->format('d/m/Y')}}</p>
        <p class="card-text"><strong>Tipo: </strong> {{$proposition->type_proposition->nome}}</p>
        <p class="card-text"><strong>Situação: </strong> {{$proposition->situation->nome}}</p>
        <p class="card-text"><strong>Descrição: </strong> {{$proposition->descricao}}</p>

      </div>
      <div class="col-sm-6">

        <p class="card-text"><strong>Autor(s): </strong></p>
        @foreach ($proposition->author as $councilor)
        <h6>{{$councilor->nome}}</h6>
        {{-- <div class="icheck-primary icheck-block  {{ $errors->has('councilors') ? 'is-invalid' : '' }}">
          <input type="checkbox" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}" disabled
            @isset($proposition) @foreach ($proposition->councilors as $minuteCouncilor)
          {{$councilor->id == $minuteCouncilor->id ? 'checked' : ''}}
          @endforeach
          @endisset />
          <label for="{{$councilor->id}}"> {{$councilor->nome}}</label>
        </div> --}}
        @endforeach

      </div>
    </div>
    <div class="row border-top mt-2 ">
      <div class="col-sm-12">

        <strong class="mb-3">Anexos:</strong> ​
        @foreach ($proposition->attachments as $attachment)
        <p>
          <a href="{{config('app.aws_url')." {$attachment->anexo}" }}" target="_blank" class="mb-2 mt-2 mr-4 text-reset"
            >
            <i class="far fa-file-pdf fa-2x text-danger"></i>
            <span class="mr-3"> {{$attachment->nome_original}}</span>
          </a>
        </p>

        @endforeach
      </div>
    </div>

    <div class="row border-top">
      <div class="col-sm-12">
        <p class="text-center"><strong>Votações</strong> </p>
        @if(count($votos)> 0 )
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Vereador</th>
              <th scope="col">Voto</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($votos as $voto)
            <tr>
              <td>{{$voto->vereador}}</td>
              <td>{{$voto->voto}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <div class="alert alert-secondary" role="alert">
          A propositura ainda não foi votada.
        </div>
        @endif
      </div>
    </div>
    @stop