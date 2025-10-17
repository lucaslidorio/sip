<footer class="footer text-center  ">

    <div class="container ">
        <span class="inner ">
            <div class="fs-2 text-white">
                <strong>Responsável para assegurar o cumprimento da Lei de Acesso à Informação.</strong>
            </div>
            Nome: {{$tenant->nome_resp_transparencia}} <br />
            Telefone:{{$tenant->telefone_resp_transparencia}} <br />
            E-mail: {{$tenant->email_resp_transparencia}}
        </span>
        <address>
            <div class="row">
                <div class="col-12 text-center">
                    <img src="{{config('app.aws_url')."{$tenant->brasao}"}} "alt="" width="70%" height="70%">
                </div>
            </div>
            <div class="fs-1 text-white">
                <strong>{{$tenant->nome}}</strong>
            </div>
            <span class="inner">
                <i class="fa fa-map-marker" aria-hidden="true"></i>{{$tenant->endereco}}, {{$tenant->numero}},
                {{$tenant->bairro}}
                <br /> {{$tenant->cidade}}<br>
                <i class="fa fa-volume-control-phone" aria-hidden="true"></i> {{$tenant->telefone}} <br />
                E-mail: {{$tenant->email}} <br>
                Atendimento: {{$tenant->dia_atendimento}}.
                <hr>
                Todos os direitos reservados &copy; {{ date("Y") }} - {{$tenant->nome}}
                <span>desenvolvido por:</span>
                <a class="text-white" target="__blank" href="{{$tenant->developmentSettings->site}}">
                    {{$tenant->developmentSettings->nome_empresa}}</a>
            </span>
        </address>
    </div>
</footer>