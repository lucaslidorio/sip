@extends('public_templates.leg.default')

@section('content')
<div class="row " style="height: 60px; background-color: #f5f5f5">
    <div class="container  ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Pesquisar</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('pesquisa') }} </div>
        </div>
    </div>
</div>
<div class="container">   
      
    <h4>Resultados para: "{{ $pesquisar }}"</h4>

    @forelse($resultados as $res)
        <div class="mb-4 border-bottom pb-2">
            <p class="mb-1 text-muted"><strong>{{ $res['tabela'] }}</strong></p>
            <h3>{{ $res['titulo'] }}</h3>
            <p>{{ $res['conteudo'] }}</p>
            <a href="{{ $res['url'] }}" class="btn btn-primary  cor-padrao-bg text-white btn-sm fs-4">Ver mais</a>
        </div>
    @empty
        <p>Nenhum resultado encontrado.</p>
    @endforelse
    
</div>


</div>
</div> 


@endsection