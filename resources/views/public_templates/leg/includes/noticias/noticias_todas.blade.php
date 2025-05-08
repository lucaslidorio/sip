@extends('public_templates.leg.default')

@section('content')

<style>
    .row.mb-3 a {
        display: block;
        /* Garante que o link cobre toda a área do conteúdo */
        transition: transform 0.3s ease, background-color 0.3s ease;
        /* Suaviza o zoom e outras transições */
        background-color: transparent;
        /* Remove o fundo cinza inicial */
    }

    .row.mb-3 a:hover {
        transform: scale(1.03);
        /* Aumenta ligeiramente o tamanho do link */
        background-color: transparent;
        /* Mantém o fundo transparente no hover */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        /* Adiciona uma sombra para destacar */
    }
    .pagination {
    font-size: 1.2rem; /* Aumenta o tamanho do texto */
    padding: 10px 0;  /* Adiciona espaço ao redor */
}

.pagination .page-link {
    font-size: 1.2rem; /* Aumenta o tamanho do link */
    padding: 10px 15px; /* Torna os botões maiores */
    color: #007bff; /* Cor do texto */
    border-radius: 5px; /* Deixa os botões arredondados */
    text-decoration: none; /* Remove sublinhado */
    border: 1px solid #ddd; /* Adiciona borda */
    transition: background-color 0.3s ease, color 0.3s ease; /* Suaviza o hover */
}

.pagination .page-link:hover {
    background-color: #007bff; /* Cor de fundo ao passar o mouse */
    color: #fff; /* Cor do texto ao passar o mouse */
}

.pagination .page-item.active .page-link {    
    color: #fff; /* Cor do texto do botão ativo */
    border-color: #007bff; /* Borda do botão ativo */
}
</style>
<div class="row  border-top-blue" style="height: 60px; background-color: #f5f5f5">
    <div class="container  ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Noticias e informativos</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('noticias') }}</div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-8">
            <main class="py-4 me-4">
                @foreach ($noticias as $noticia)
                <div class="row mb-3 ">
                    <a href={{route('noticias.show',$noticia->url) }} class="text-decoration-none text-body">
                        <div class="col-md-3 float-start">
                            <img src="{{config('app.aws_url').$noticia->img_destaque}}" width="100%" height="100%"
                                alt="" class="img-responsive" />
                        </div>
                        <div class="col md-9">
                            <h4 class=""><strong>{{Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</strong> -
                                {{$noticia->titulo}}</h4>
                            <p id="limiteLinha">
                                {!! Str::limit(strip_tags($noticia->conteudo), 250, '...') !!}
                            </p>
                        </div>
                        @foreach ($noticia->categories as $item)
                        <span class="badge bg-secondary mb-2">{{$item->nome}}</span>
                        @endforeach 
                    </a>
                </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    {{ $noticias->links() }}
                </div>
            </main>
            
        </div>


        <div class="col-12 col-md-4">
            @include('public_templates.leg.includes.noticias.pesquisa_categoria_lateral')
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paragrafo = document.getElementById("limiteLinha");
        const maxPalavras = 50;        
                if (paragrafo) {
            const palavras = paragrafo.textContent.trim().split(/\s+/);
            
            console.log(palavras);
            if (palavras.length > maxPalavras) {
                const textoTruncado = palavras.slice(0, maxPalavras).join(" ") + "...";
                paragrafo.textContent = textoTruncado;
            }
        }
    });
</script>
@endsection