@extends("public_templates.leg.default")
@section('title', 'Estatísticas da Pesquisa')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')
<div class="row" style="background-color: #f5f5f5; height: 60px">
    <div class="container">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Estatísticas da Pesquisa</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('estatisticas') }}</div>
        </div>
    </div>
</div>

<div class="container mt-4">
        @foreach ($graficos as $index => $grafico)
        <div class="card mb-5">
            <div class="card-header bg-light">
                <strong>{{ $grafico['titulo'] }}</strong>
            </div>
            <div class="card-body">
                <canvas id="grafico-{{ $index }}" height="120"></canvas>
            </div>
        </div>
    @endforeach
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const graficos = @json($graficos);

        graficos.forEach((grafico, index) => {
            const ctx = document.getElementById(`grafico-${index}`).getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: grafico.labels,
                    datasets: [{
                        label: 'Quantidade de respostas',
                        data: grafico.dados,
                        backgroundColor: grafico.cores,
                        borderColor: grafico.cores,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    });
</script>
@endsection

@section('js')


@endsection
