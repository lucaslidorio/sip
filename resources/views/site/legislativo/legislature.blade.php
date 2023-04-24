
@extends('site.legislativo.layouts.default')

@section('content')
<div class="container ">
<section class="text-center">
  <div class="row">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light"></h1> {{$legislature->descricao}}</h1>
      <p class="lead text-muted"> De {{\Carbon\Carbon::parse($legislature->data_inicio)->format('d/m/Y')}}
      a {{\Carbon\Carbon::parse($legislature->data_fim)->format('d/m/Y')}}</p>
     </div>
  </div>
</section> 

<div class="row ">
    @foreach ($legislature->councilors as $vereador)
    <div class="col-sm-3 col-lg-3 mt-2 ">
      <div class="card shadow-sm">
        <img src="{{config('app.aws_url')."{$vereador->img}" }}"
       class=" img-fluid" alt="{{$vereador->nome}}">
        <div class="card-body">
          <p class="card-text"></p> {{$vereador->nome}}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{route('camara.vereador', $vereador->id)}}" type="button" class="btn btn-sm btn-outline-secondary">Detalhes</a>
              {{-- <button type="button" class="btn btn-sm btn-outline-secondary">Proposituras</button> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  
</div>
</div>
@endsection