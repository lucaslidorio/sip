@extends('site.legislativo.layouts.default')

@section('content')
{{Breadcrumbs::render('mesas_diretora')}}
<h3 class="font-blue text-center">Mesa Diretora</h3>
<div class="row">
    <ul class="nav nav-tabs">
        @foreach($directorTables as $mesaDiretora)
            <li class="nav-item">
                <a class="nav-link font-blue {{$mesaDiretora->atual == 1 ? 'active': ''}}" data-bs-toggle="tab"
                    href="#tab{{$mesaDiretora->id}}">{{$mesaDiretora->nome}}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @for ($i = 0; $i < count($membrosMesaDiretora); $i++) @foreach ($membrosMesaDiretora[$i] as $membros) @endforeach 
        <div class="tab-pane fade
                        @foreach($directorTables as $mesaDiretora)
                        {{$mesaDiretora->atual == 1 ? 'show active': ''}}
                        @endforeach
        " id="tab{{$membros->director_table_id}}">
            <h5 class="pt-2">Objetivo</h5>
            <p>{{$membros->directorTable->objetivo}}</p>
            <h2 class="text-center  border-bottom  "><span>Membros</span></h2>
            <div class="row text-center">
                @foreach ($membrosMesaDiretora[$i] as $membros)
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                    <div class="">
                        <div class="text-center">
                            <a class=""
                                href="{{config('app.aws_url').$membros->members->img }}">
                                <img src="{{config('app.aws_url').$membros->members->img  }}" class=""
                                    alt="" style="width: 150px">                               
                            </a>
                        </div>
                    </div>
                    <h6 class="font-blue text-center ">{{$membros->functions->nome}}</h6>
                    <h6 class="text-center">{{$membros->members->nome}} - {{$membros->members->party->sigla}}</h6>
                    <p class="text-center"><a class="btn rounded-0 text-white"
                            href="{{route('camara.vereador', $membros->members->id)}}" role="button" style="background-color: #0b468e">Ver Detalhes
                    </a></p>
                </div>
                @endforeach
            </div>
        </div>
        @endfor
    </div>
</div>
@endsection