<style>
    /* Transição para transformações e filtros */
    .zoom-link img {
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    /* Quando o mouse estiver sobre o container, todas as imagens ficam escuras */
    .lista1:hover .zoom-link img {
        filter: brightness(0.5);
    }

    /* A imagem que estiver com o mouse volta ao brilho normal e aplica o zoom */
    .lista1:hover .zoom-link:hover img {
        filter: brightness(1);
        transform: scale(1.1);
    }
</style>
@if($linksInferior->isNotEmpty())
<div class="col" style="height : 550px ;">
    <div class="col-md-12 col-sm-12">
        <section class="quick-access">
            <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
                <h1>
                    <span>
                        ATALHOS
                    </span>
                </h1>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row lista1 text-center mt-3">
                        @foreach ($linksInferior as $link)
                        <div class="col-sm-12 col-md-12 mb-sm-12 m-2">
                            <a href="{{ $link->url }}" target="{{ $link->target == 1 ? '__blank' : '' }}"
                                class="zoom-link">
                                <img src="{{ config('app.aws_url') . $link->icone }}" class="img-responsive"
                                    alt="{{ $link->nome }}">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endif