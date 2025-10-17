@extends('public_templates.leg.default')

@section('content')
<div class="row " style="height: 60px; background-color: #f5f5f5">
  <div class="container  ">
      <div class="row mt-4">
          <div class="col-8">
              <p class="fs-1">Acompanhamento de Manifestação</p>
          </div>
          <div class="col-4 fs-4">{{ Breadcrumbs::render('ouvidora_acompanhamento', $ouvidoria) }}</div>
           
      </div>
  </div>
</div>
<main class="container my-5">
    @if($ouvidoria !== null)
      {{--  --}}
    @endif
  
  
  
    <section class="row">
      <div class="col-12">
        @if($ouvidoria === null)
          <div class="alert alert-danger" role="alert">
            <p class="h5 fw-bold">Não foi possível encontrar uma manifestação com o protocolo informado.</p>
            <p class="mb-0"><strong>Verifique o protocolo informado e tente novamente.</strong></p>
          </div>
        @else
          <article class="alert alert-success" role="alert">
            <h2 class="h5 fw-bold mb-3">Informação da Manifestação</h2>
            <p><strong>Sigiloso:</strong> {{ $ouvidoria->sigiloso == 0 ? 'Não' : 'Sim' }}</p>
            <p><strong>Assunto:</strong> {{ $ouvidoria->assunto_ouvidoria ? $ouvidoria->assunto_ouvidoria->nome : 'Não informado' }}</p>
            <p><strong>Data do Protocolo:</strong> {{ \Carbon\Carbon::parse($ouvidoria->created_at)->format('d/m/Y') }}</p>
            <p class="h5 mt-3"><strong>Protocolo:</strong> {{ $ouvidoria->codigo }}</p>
          </article>
  
          <article class="alert alert-secondary" role="alert">
            <h2 class="h5 fw-bold mb-2">Manifestação</h2>
            <p class="fs-5 mb-0">{{ $ouvidoria->manifestacao }}</p>
          </article>
  
          @foreach($ouvidoria->resposta_ouvidoria as $resposta_ouvidoria)
            <article class="alert alert-info ms-3" role="alert">
              <h2 class="h5 fw-bold mb-2">Resposta</h2>
              <p class="fs-5">{{ $resposta_ouvidoria->resposta }}</p>
              <p class="text-end mb-0">
                Respondido por: {{ $resposta_ouvidoria->user->name }} em
                {{ \Carbon\Carbon::parse($resposta_ouvidoria->created_at)->format('d/m/Y H:i') }}
              </p>
            </article>
          @endforeach
        @endif
      </div>
    </section>
  </main>
  
@endsection