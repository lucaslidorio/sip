<!-- Mostra os Links da posição direita -->
<style>
        /* Transição suave para as imagens */
    .zoom-link img {
        transition: transform 0.3s ease, filter 0.3s ease;
    }

    /* Quando o mouse estiver sobre o container, todas as imagens ficam escuras */
    .links-container:hover .zoom-link img {
        filter: brightness(0.7);
    }

    /* Quando o mouse estiver sobre um link, a imagem fica com brilho normal e aplica o zoom */
    .links-container .zoom-link:hover img {
        filter: brightness(1);
        transform: scale(1.1);
    }

</style>
<section class="col-sm-12 col-md-6 highlights-container corousel">

    <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
        <h1>
            <span>
                Utilidade
            </span>
        </h1>
    </div>

    <div class="row text-center links-container">
        @if($linksDireita->isNotEmpty())
            @foreach($linksDireita as $link)
                <section class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <a target="{{ $link->target }}" href="{{ $link->url }}" title="{{ $link->nome }}" class="zoom-link">
                        <img style="padding-bottom: 10px; width: 300px; height: 115px;" 
                             src="{{ config('app.aws_url') . $link->icone }}" 
                             alt="{{ $link->nome }}" class="img-responsive" />
                    </a>
                </section>
            @endforeach
        @endif
    </div>       

</section>