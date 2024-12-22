<footer class="footer text-center hidden-print">
    <div class="container">
        <address>
            <span class="header">
                <div style="margin-top: 15px;">
                   <strong>{{$tenant->nome}}</strong>
                </div>
            </span>

            <span class="inner">
                <i class="fa fa-map-marker" aria-hidden="true"></i>{{$tenant->endereco}}, {{$tenant->numero}}, {{$tenant->bairro}}
               <br /> {{$tenant->cidade}}<br>
                <i class="fa fa-volume-control-phone" aria-hidden="true"></i> {{$tenant->telefone}} <br />
                E-mail: {{$tenant->email}} <br>
                Atendimento: {{$tenant->dia_atendimento}}.
                <hr>
                Todos os direitos reservados &copy; {{ date("Y") }} - {{$tenant->nome}}  
                <span>desenvolvido por:</span>
                <a class="text-white" href="{{$tenant->developmentSettings->site}}">
                    {{$tenant->developmentSettings->nome_empresa}}</a>
            </span>
        </address>
    </div>
</footer>