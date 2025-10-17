@extends('public_templates.leg.default')

<style>
    .text-justify {
    text-align: justify;
}
</style>
@section('content')
<div class="row" style="background-color: #f5f5f5">
    <div class="container">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Pesquisa de Satisfação</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('pesquisa_satisfacao') }}</div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h2 class="text-center fw-bold">{{ $questionario->titulo }}</h2>
    <h3 class="text-justify">{{ $questionario->descricao }}</h3>
    <form action="{{ route('site.pesquisa.responder') }}" method="POST">
        @csrf
        <input type="hidden" name="questionario_id" value="{{ $questionario->id }}">

        @foreach($questionario->perguntas as $pergunta)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ $loop->iteration }}. {{ $pergunta->pergunta }}</h3>
                    @foreach($pergunta->alternativas as $alternativa)
                        <div class="form-check">
                            <input class="form-check-input" type="radio"
                                name="respostas[{{ $pergunta->id }}]"
                                id="alt{{ $alternativa->id }}"
                                value="{{ $alternativa->id }}" required>
                            <label class="form-check-label" for="alt{{ $alternativa->id }}">
                                {{ $alternativa->alternativa }}
                                
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary cor-padrao-bg text-white btn-sm fs-4">
                Enviar Respostas
            </button>
        </div>
    </form>
</div>
@endsection
