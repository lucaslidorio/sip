<style>
   .news-carousel-container {
    overflow: hidden;
    height: 400px; /* Altura fixa para exibir 4 notícias de cada vez */
    position: relative;
}

.news-carousel {
    display: flex;
    flex-direction: column;
    animation: scroll-up 90s linear infinite; /* Rolagem contínua */
    animation-play-state: running; /* Certifica-se de que a animação começa rodando */
    cursor: grab; /* Indica que o usuário pode arrastar */
    user-select: none; /* Impede que o texto fique selecionado ao arrastar */

}
.news-carousel:active {
    cursor: grabbing; /* Muda o cursor enquanto está segurando */
}

.news-item {
    display: flex;
    width: 100%;
    padding-bottom: 10px;
}
/* Remove qualquer fundo que esteja sendo aplicado ao passar o mouse */
.news-item a {
    display: block; /* Garante que o link cubra toda a área da notícia */
    text-decoration: none;
    transition: transform 0.3s ease, background-color 0.3s ease;
}
/* Adiciona pausa quando o mouse passa sobre o carrossel */
.news-carousel:hover {
    animation-play-state: paused;
}
/* Efeito hover: aumento leve e sombra para destacar */
.news-item a:hover {
    transform: scale(1.02); /* Pequeno zoom ao passar o mouse */
    background-color: rgba(0, 0, 0, 0.05); /* Fundo levemente acinzentado */
    border-radius: 5px; /* Bordas arredondadas para suavizar o efeito */
}


/* Evita que as imagens e textos dentro do link fiquem afetados pelo hover */
.news-item img {
    transition: transform 0.3s ease;
}

.news-item a:hover img {
    transform: scale(1.05); /* Pequeno zoom na imagem */
}

@keyframes scroll-up {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-100%); /* Move as notícias para cima continuamente */
    }
}

</style>

<div class="container col-md-12 col-sm-12">
    <section class="quick-access" style="padding-bottom: 10px;">
        <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
            <h1>
                <span>
                    Noticias
                </span>
            </h1>
        </div>   
        
        

        <div class="news-carousel-container" style="overflow: hidden; height: 400px; position: relative;">
            <div class="news-carousel">
                @foreach ($noticias as $noticia)
                <div class="news-item col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
                    <a href="{{ route('noticias.show', $noticia->url) }}">
                        <section class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                            <img width="100%" height="100%"
                                src="{{ config('app.aws_url') . $noticia->img_destaque }}"
                                alt="" class="img-responsive" />
                        </section>
                        <section class="col-lg-10 col-md-10 col-sm-8 col-xs-8" style="color: #666;">
                            <h5><strong>{{ Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y') }}</strong> - {{ $noticia->titulo }}</h5>
                            <p id="limiteLinha">
                                {!! Str::limit(strip_tags($noticia->conteudo), 250, '...') !!}
                            </p>
                        </section>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        


        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
            <a href="{{route('noticias.todas') }}">
                <section class="col-lg-12 col-md-12 col-sm-12 col-xs-12"
                    style="text-align: center; color: #2370B7;">
                    <strong>
                        Ver mais
                    </strong>
                </section>
            </a>
        </div>
    </section>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const newsCarousel = document.querySelector(".news-carousel");
    const newsItems = document.querySelectorAll(".news-item");

    // Clona os itens para criar um efeito de rolagem infinita
    newsItems.forEach(item => {
        let clone = item.cloneNode(true);
        newsCarousel.appendChild(clone);
    });

    // Pausar animação ao passar o mouse
    newsCarousel.addEventListener("mouseenter", function () {
        newsCarousel.style.animationPlayState = "paused";
    });

    // Retomar animação ao tirar o mouse
    newsCarousel.addEventListener("mouseleave", function () {
        newsCarousel.style.animationPlayState = "running";
    });

    // Implementação do arrasto com o mouse
    let isDragging = false;
    let startY;
    let scrollTop;

    newsCarousel.addEventListener("mousedown", function (e) {
        isDragging = true;
        startY = e.pageY - newsCarousel.offsetTop;
        scrollTop = newsCarousel.scrollTop;
        newsCarousel.style.cursor = "grabbing"; // Muda o cursor ao segurar
        newsCarousel.style.animationPlayState = "paused"; // Pausa a rolagem enquanto arrasta
    });

    document.addEventListener("mouseup", function () {
        isDragging = false;
        newsCarousel.style.cursor = "grab"; // Retorna o cursor normal
        newsCarousel.style.animationPlayState = "running"; // Retoma a rolagem ao soltar
    });

    document.addEventListener("mousemove", function (e) {
        if (!isDragging) return;
        e.preventDefault();
        const y = e.pageY - newsCarousel.offsetTop;
        const walk = (y - startY) * 2; // Ajusta a sensibilidade do arrasto
        newsCarousel.scrollTop = scrollTop - walk;
    });

    // Ajuste para limitar o número de palavras do parágrafo
    const paragrafos = document.querySelectorAll("#limiteLinha");
    const maxPalavras = 50;

    paragrafos.forEach(paragrafo => {
        if (paragrafo) {
            const palavras = paragrafo.textContent.trim().split(/\s+/);
            if (palavras.length > maxPalavras) {
                const textoTruncado = palavras.slice(0, maxPalavras).join(" ") + "...";
                paragrafo.textContent = textoTruncado;
            }
        }
    });
});


</script>