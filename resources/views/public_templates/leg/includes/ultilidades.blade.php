<!-- Mostra os Links da posição direita -->
<section class="col-sm-12 col-md-6 highlights-container corousel">

    <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
        <h1>
            <span>
                Utilidade
            </span>
        </h1>
    </div>

    <div class="row text-center">


       @if($linksDireita->isNotEmpty())
        @foreach($linksDireita as $link)
        <section class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <a target="{{ $link->target }}" href="{{ $link->url }}" title="{{$link->nome}}">
                <img style="padding-bottom: 10px; width: 300px; height: 115px;" src="{{config('app.aws_url')."{$link->icone}"
                }}" alt="{{$link->nome}}" class="img-responsive" />
            </a>
        </section>
        @endforeach
        
        @endif
             

</section>