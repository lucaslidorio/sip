<section class="col-sm-12 col-md-6 highlights-container corousel">
    <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
        <h1>
            <span>
                Destaque
            </span>
        </h1>
    </div>

    <div class="slide-destaque">
        @foreach($posts_destaque as $post)
            <img style="width:500px; height:578px"
                 src="{{ config('app.aws_url') . $post->img_destaque }}"
                 alt="{{ $post->titulo }}" class="img-responsive" />
        @endforeach
    </div>
    
    <div class="highlights-texts">
        @foreach($posts_destaque as $post)
            <section>
                <h2>
                    <a href="{{ route('noticias.show', $post->url) }}">
                        {{ $post->titulo }}
                    </a>
                </h2>                
                <p>

                    <a href="{{ route('noticias.show', $post->url) }}">
                        <p id="limiteLinha">
                            {!! Str::limit(strip_tags($post->conteudo), 100, '...') !!}
                        </p>
                    </a>
                </p>
            </section>
        @endforeach
    </div>
    
    <div class="highlights-dots"></div>
    

    {{-- <div class="slide-destaque">     


        <img style="width:500; height:578px"
            src="http://minio-producao.jelastic.saveincloud.net/teixeiropolis/posts/H4jnArhACcSgG1VKXuu5naObowAJyBRqId7FuyJX.jpg"
            alt="“Outubro Rosa e Verde”" class="img-responsive" />

        <img style="width:500; height:578px"
            src="http://minio-producao.jelastic.saveincloud.net/teixeiropolis/posts/I1d7xh6UFcOgblaVoY6V9Xx9XE9qG0yZylWGHKNx.jpg"
            alt="Dia do Servidor Público" class="img-responsive" />
    </div>

    <div class="highlights-texts">
        <section>
            <h2>
                <a href="https://www.teixeiropolis.ro.gov.br/noticias/outubro-verde-e-rosa">
                    Prevenção é o melhor caminho.
                </a>
            </h2>
            <p>
                <a href="https://www.teixeiropolis.ro.gov.br/noticias/outubro-verde-e-rosa">
                    “Prevenção é o melhor caminho.” O autoexame e a mamografia são essenciais para
                    detectar o câncer de mama em estágios iniciais. Cuide-se, toque-se, e faça os
                    exames
                    regularmente.
                </a>
            </p>
        </section>
        <section>
            <h2>
                <a href="">
                    Dia do Servidor Público
                </a>
            </h2>
            <p>
                <a href="">
                    O Dia do Servidor Público é comemorado no dia 28 de outubro e é uma data para
                    homenagear
                    os trabalhadores da administração pública.
                </a>
            </p>
        </section>

    </div>
    <div class="highlights-dots"></div> --}}
</section>
<script>
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
</script>