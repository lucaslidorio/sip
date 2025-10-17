@extends('public_templates.leg.default')
@section('content')

<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Pronunciamento </p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('pronunciamento', $pronunciamento)}}</div>
        </div>
    </div>
</div>
<div class="container">
    @include('public_templates.leg.includes.pronunciamentos.form_pesquisa')

    <h3 class="mb-4">
        Pronunciamento do Vereador {{$pronunciamento->councilor->nome}}
    </h3>
    <!-- Dados da Sessão -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row me-3">
                <!-- Coluna 1 -->
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center text-center">
                    @if($pronunciamento->councilor->img)
                    <img src="{{config('app.aws_url').$pronunciamento->councilor->img}}" alt="Foto do vereador"
                        class="img-fluid rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                    <img src="{{config('app.aws_url').'uteis/no-image.jpg'}}" alt="Sem foto"
                        class="img-fluid rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover;">
                    @endif
                    <div class="mt-2 fw-bold">
                        {{ $pronunciamento->councilor->nome }}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <p class="mb-2 fs-4">
                            <strong>Sessão:</strong>
                            Sessão {{ $pronunciamento->session->nome }} –
                            {{ \Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="row">
                        <h4 class="mb-3 fw-bold">Discurso</h4>

                    </div>
                    <div class="row">
                        {!!$pronunciamento->discurso !!}
                    </div>
                    <div class="row">
                        @if($pronunciamento->link_video)
                        <div class="mt-4">
                            <h4 class="mb-2 fw-bold">Vídeo</h4>
                            <div class="ratio ratio-16x9">
                                <iframe src="{{ embedVideo($pronunciamento->link_video) }}" frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            

        </div>
        <div class="card mb-4 mt-5">
            <div class="card-header cor-padrao-bg text-white">
                <h4 class="mb-0">Outros Pronunciamentos deste vereador</h4>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 p-3">
                @forelse ($outrosDoVereador as $item)
                    <div class="col-md-2">
                        <div class="p-3 border-bottom">

                            <a href="{{route('camara.pronunciamento.show', $item->id) }}" class="text-decoration-none">
                                <i class="fas fa-bullhorn fs-1 d-block text-center text-muted mb-2"></i>
                                <p class="fs-4 fw-bold text-center mb-1">
                                  {{ $item->session->nome }} – {{ \Carbon\Carbon::parse($item->session->data)->format('d/m/Y') }}
                                </p>
                            </a>                          
                          
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">Nenhum outro pronunciamento encontrado.</div>
                @endforelse
            </div>
        </div>
        

        <div class="card mb-4 mt-3">
            <div class="card-header cor-padrao-bg text-white">
                <h4 class="mb-0">Outros Pronunciamentos desta sessão</h4>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 p-3">
                @forelse ($outrosDaSessao as $item)
                    <div class="col-md-2">
                        <div class="p-3 border-bottom text-center">
                            <a href="{{route('camara.pronunciamento.show', $item->id) }}"  class="text-decoration-none">
                                <i class="fas fa-user-tie fs-1 text-muted mb-2"></i>
                                <p class="fs-4 fw-bold mb-1">{{ $item->councilor->nome }}</p>                           </a>                          
                            
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-4 text-muted">Nenhum outro pronunciamento nesta sessão.</div>
                @endforelse
            </div>
        </div>
        


        <div class="card-footer">
            <div class="">
                <a href="{{ route('camara.pronunciamentos', ['councilor' => $pronunciamento->councilor_id]) }}"
                    class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3">
                    <i class="fas fa-arrow-left me-1"></i> Voltar
                </a>
            </div>
        </div>
    </div>


    

</div>

@endsection