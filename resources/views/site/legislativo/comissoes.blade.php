@extends('site.legislativo.layouts.default')

@section('content')
{{ Breadcrumbs::render('comissoes') }} 
<h3 class="font-blue text-center">Comissões</h3>
<div class="row">
    <ul class="nav nav-tabs">
        @foreach($commissions as $comissao)
            <li class="nav-item">
                <a class="nav-link font-blue {{$loop->index ==0 ? 'active': ''}}" data-bs-toggle="tab"
                    href="#tab{{$comissao->id}}">{{$comissao->nome}}</a>
            </li>
        @endforeach
    </ul>
    <div class="tab-content">
        @for ($i = 0; $i < count($membrosComissao); $i++) @foreach ($membrosComissao[$i] as $membros) @endforeach 
        <div class="tab-pane fade {{$i == 0 ? 'show active': ''}}" id="tab{{$membros->commission_id}}">
            <h5 class="pt-2">Objetivo</h5>
            <p>{{$membros->commission->objetivo}}</p>
            <h2 class="text-center  border-bottom  "><span>Membros</span></h2>
            <div class="row text-center">
                @foreach ($membrosComissao[$i] as $membros)
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