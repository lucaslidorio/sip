@if($vereadores->isNotEmpty())
<div class="container col-md-12 col-sm-12">
    <section class=" highlights2-container corousel">
        <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
            <h1>
                <span>
                    Vereadores
                </span>
            </h1>
        </div>

        <div class="slide-vereadores box-centralizada">
            <div class="highlights2-texts">
    @foreach($vereadores->chunk(4) as $chunk)
        <div class="container">
            <div class="row">
                @foreach($chunk as $vereador)
                    <div class="col">
                        <img style="width:100%; height:280px" class="img-fluid"
                            src="{{ config('app.aws_url') . "{$vereador->img}" }}"
                            alt="{{ $vereador->nome }}" class="img-responsive" />
                        <section>
                            <a href="{{ route('camara.vereador', $vereador->id) }}" role="button">
                                <h4>
                                    <div style="width: 100%;" class="col-md-1 col-sm-1 col-xs-1">
                                        <div style="width: 80px; float: left;">
                                            <img width="50px"
                                                src="{{ config('app.aws_url')."{$vereador->party->img}" }}"
                                                alt="">
                                        </div>
                                        <div
                                            style="width: 70%; padding-top: 3%; float: right; color: #666;">
                                            {{ $vereador->nome }}
                                        </div>
                                    </div>
                                </h4>
                            </a>
                        </section>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
                

            </div>

        </div>
        <div class="highlights2-dots"></div>
    </section>
</div>