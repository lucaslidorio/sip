
@extends('site.legislativo.layouts.default')

@section('content')
<div class="row">  
    @foreach ($legislatures as $legislatura)
    <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
    <div class="rounded-0 card" style="border-color:{{$legislatura->atual ? '#0b468e' : ''}}">
      <h5 class="card-header">{{$legislatura->descricao}}</h5>
      <div class="card-body">
        <h5 class="card-title fw-bold text-center">{{$legislatura->atual ? 'Atual' :  ''}}</h5>
        <h6><strong>Data de Início: </strong>{{\Carbon\Carbon::parse($legislatura->data_inicio)->format('d/m/Y')}}</h6>
        <h6><strong>Data de Fim: </strong>{{\Carbon\Carbon::parse($legislatura->data_fim)->format('d/m/Y')}}</h6>
        <a href="{{route('camara.legislatura', $legislatura->id)}}" class="btn btn-secondary rounded-0  d-flex justify-content-center " style="background-color: #0b468e"
        ><span><i class="bi bi-people">&nbsp;</i>Ver Vereadors</span></a>
      </div>
    </div>
  </div>
    @endforeach
  
</div>
@endsection