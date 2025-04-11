@extends('public_templates.leg.default')

@section('content')

<div class="container">
    <h2 class="mb-4">Pesquisar</h2>
      
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