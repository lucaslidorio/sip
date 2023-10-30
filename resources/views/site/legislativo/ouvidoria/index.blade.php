
@extends('site.legislativo.layouts.default')

@section('content')

    <div class="row">                             
        <div id="portfolio" class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">
                    <div class="link font-blue">                      
                            <div class="card p-2 text-center border-primary rounded-0 ">                               
                                    <p class="font-weight-bold" style="font-size: 150%">CONSULTAR PROTOCOLO</p>
                                    <p class="card-text">Consulte suas Manifestações. <br>&nbsp;</p>
                                <div class="card-body">
                                    <form action="{{route('ouvidoria.acompanhamento')}}" method="get">
                                        @csrf
                                        <div class="row">
                                            <input class="form-control" name="codigo" type="text" placeholder="Protocolo">
                                        </div>
                                        <div class="row">
                                            <button type="subimit" class="btn btn-primary btn-block">Consultar</button>
                                        </div>
                                    </form>                                           
                                </div>
                            </div>                     
                    </div>
                </div>
            </div>


            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item ">             
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoria.create', 1)}}"> {{-- 1 = Reclamação --}}                                    
                            <div class="card rounded-0 border-1 mb-2">
                                <img class=" img-fluid"
                                    src="{{ url('../site/img/ouvidoria/reclamacao.png') }}" alt="imagem de reclamação">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">RECLAMAÇÃO</p>
                                    <p class="card-text ">Envie sua insatisfação com o serviço público.
                                        </p>
                                </div>
                            </div>
                        </a>                    
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoria.create',2)}}">{{-- 2 = ELOGIO --}} 
                            <div class="card  rounded-0 border-1 mb-2 ">
                                <img class="img-fluid"
                                    src="{{ url('../site/img/ouvidoria/elogio.png') }}" alt="imagem de elogio">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">ELOGIO</p>
                                    <p class="card-text">Expresse se você está satisfeito com o atendimento
                                        público.</p>
                                </div>
                            </div>
                        </a>                    
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">                    
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoria.create', 3)}}">{{--3 = SOLICITAÇÃO --}}
                            <div class="card  rounded-0 border-1 mb-2">
                                <img class="img-fluid"
                                    src="{{ url('../site/img/ouvidoria/solicitacao.png') }}" alt="imagem de solicitacao">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">SOLICITAÇÃO</p>
                                    <p class="card-text">Peça atendimento ou uma prestação de serviço. <br>&nbsp;</p>
                                </div>
                            </div>
                        </a>                    
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoria.create', 4)}}">{{--4 = SUGESTÃO --}}
                            <div class="card rounded-0 border-1 mb-2">
                                <img class=" img-fluid"
                                    src="{{ url('../site/img/ouvidoria/sugestao.png') }}" alt="imagem de sugestão">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">SUGESTÃO</p>
                                    <p class="card-text">Envie uma ideia ou proposta de melhoria dos serviços
                                        públicos.</p>
                                </div>
                            </div>
                        </a>                    
                </div>
            </div>
         
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">                    
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoriaSite.duvidas')}}">
                            <div class="card rounded-0 border-1 mb-2">
                                <img class=" img-fluid"
                                    src="{{ url('../site/img/ouvidoria/duvidas.png') }}" alt="imagem de dúvida">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">DÚVIDAS</p>
                                    <p class="card-text">FAQ com perguntas frequentes.</p>
                                </div>
                            </div>
                        </a>                    
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 ">
                <div class="portfolio-item">                    
                        <a class="banner text-decoration-none link font-blue" href="{{route('ouvidoria.create', 6)}}">{{--6 = DENÚNCIA --}}
                            <div class="card rounded-0 border-1 mb-2">
                                <img class=" img-fluid"
                                    src="{{ url('../site/img/ouvidoria/denuncia.png') }}" alt="imagem de denuncia">
                                <div class="card-body">
                                    <p class="font-weight-bold" style="font-size: 150%">DENÚNCIA</p>
                                    <p class="card-text">Comunique um ato ilícito pratica por agentes públicos.
                                    </p>
                                </div>
                            </div>
                        </a>
                    
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row p-2 text-justify">
       <p>
             A Ouvidoria Pública se apresenta como mais um dos instrumentos da democracia participativa,
            através da  Lei nº 13.460 <a  target="__blank" href="http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2017/lei/L13460.htm">clique aqui</a>  , de 26 de julho de 2017, pois é um setor da Administração 
            que permite o diálogo entre o cidadão, usuário dos serviços públicos, e as unidades de gestão. E
            sta mediação legitima a Ouvidoria como importante instrumento de controle social, pois a análise 
            das manifestações recebidas serve de base para informar os gestores públicos sobre problemas e 
            dificuldades existentes, de modo a provocar a melhoria dos serviços públicos prestados.  
        </p>
        <p>Tipos de manifestação:</p>
        <p>
            <strong>DENÚNCIA:</strong> Se você quer comunicar a ocorrência de um ato ilícito ou uma irregularidade praticada
            contra a administração pública. Também pode ser usada para denunciar uma violação aos direitos
            humanos. Em alguns casos, a sua manifestação não será classificada como uma denúncia e sim uma
            solicitação. Por exemplo, se faltam remédios em um hospital público, você poderá fazer uma 
            solicitação para que o órgão tome uma providência. Então, não se trata de uma denúncia.  
        </p>
        <p>
           <strong>RECLAMAÇÃO:</strong> Se você quer demonstrar a sua insatisfação com um serviço público. Você pode fazer críticas, relatar 
           ineficiência. Também se aplica aos casos de omissão. Por exemplo, você procurou um atendimento ou serviço,
           e não teve resposta.
        </p>
        <p>
            <strong>SOLICITAÇÃO:</strong> Se você espera um atendimento ou a prestação de um serviço. 
            Pode ser algo material, como receber um medicamento, ou a ação do órgão em uma situação específica. 
            Por exemplo, se alimentos fora da validade estiverem à venda, você pode solicitar que um órgão 
            público faça uma fiscalização.
        </p>
        <p>
            <strong>SUGESTÃO:</strong> 
            Se você tiver uma ideia, ou proposta de melhoria dos serviços públicos.
        </p>
        <p>
            <strong>ELOGIO:</strong> Se você foi bem atendimento e está satisfeito com o atendimento, e / ou 
            com o serviço que foi prestado.
        </p>
        <p class="pt-3">Consulte sua manifestação <br>
            Se você já fez uma manifestação e guardou o número de protocolo, pode acompanhar o andamento.
             Para isso, digite o protocolo em  <strong>CONSULTAR PROTOCOLO</strong> no início da página. 
        </p>
    </div>

 
</section>
@endsection