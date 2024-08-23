@extends('site.legislativo.layouts.default')

@section('content')
    {{ Breadcrumbs::render('enquete_nome', $enquete) }} 
    <h3 class="font-blue text-center">Resultado da Enquete</h3>
    <h3 class="font-blue">{{ $enquete->nome }}</h3>

    <canvas id="resultadoEnqueteChart" style="max-width: 600px; max-height: 400px;"></canvas>

    <p class="text-dark">
        Total de Votos: {{ $totalVotos }}
    </p>
@endsection

