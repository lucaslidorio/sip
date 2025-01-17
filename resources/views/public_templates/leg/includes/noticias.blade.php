<div class="container col-md-12 col-sm-12">
    <section class="quick-access" style="padding-bottom: 10px;">
        <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
            <h1>
                <span>
                    Noticias
                </span>
            </h1>
        </div>    
        @foreach ($noticias as $noticia)
        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 5px;">
            <a href={{route('noticias.show',$noticia->url) }}>
                <section class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                    <img width="100%" height="100%"
                        src="{{config('app.aws_url').$noticia->img_destaque}}"
                        alt="" class="img-responsive" />
                </section>
                <section class="col-lg-10 col-md-10 col-sm-8 col-xs-8" style="color: #666;">
                    <h5><strong>{{Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</strong> - {{$noticia->titulo}}</h5>
                    <p id="limiteLinha">                        
                        {!! Str::limit(strip_tags($noticia->conteudo), 250, '...') !!}
                    </p>
                </section>
            </a>
        </div>
        @endforeach    
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