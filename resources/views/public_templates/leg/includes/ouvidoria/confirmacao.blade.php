@extends('public_templates.leg.default')

@section('content')

<main class="container my-5">
    <header class="mb-4">
      <h1 class="h2">Ouvidoria</h1>
    </header>
  
    <section class="row">
      <div class="col-12">
        <div class="alert alert-success" role="alert">
          <p class="fs-4 fw-semibold mb-2">Solicitação protocolada com sucesso.</p>
          <p class="mb-1 fs-4 ">Salve o seu número de protocolo para acompanhar sua solicitação posteriormente.</p>
          <p class="h4"><strong>Protocolo:</strong> {{ $ouvidoria->codigo }}</p>
        </div>
      </div>
    </section>
  </main>
   
@endsection


