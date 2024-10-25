
<div class="container-fluid mt-3 border-top">
    <div class="media">
        <img class="mr-3 mt-2" src="{{ config('app.aws_url').'/uteis/assinatura-eletronica256.png' }}" alt="Ícone de Assinatura"
        style="width: 128px; height: 128px; ">
        <div class="media-body">
            <h6 class="mt-0"><strong>Assinado eletrônicamente por:</strong></h6>
            @if($assinaturas->where('status', true)->count() > 0)
                @foreach ($assinaturas as $assinatura)
                <p class="mb-1">{{$assinatura->user->name }}, <span class="text-uppercase font-weight-bold">{{$assinatura->funcao->nome}}</span> em {{ $assinatura->data_assinatura->format('d/m/Y') }} às {{
                    $assinatura->data_assinatura->format('H:i:s') }}</p>
                @endforeach 
            @else
            <p class="mb-1 text-danger"> O documento não possui assinatura válida.</p>
            @endif
            

            <p class="mt-3 mb-0"><small>Horário oficial de {{$municipio }},
                com fundamento na Lei nº 14.063/2020 e MP nº 2.200-2/2001.</small></p>
            <p class="mt-0">
                <small>A autenticidade deste documento pode ser conferida em
                    <a href="{{ config('app.url') }}/verificador/{{$codigoverificacao}}">
                        {{ config('app.url') }}/verificador/codigo
                    </a>, informando o código <strong>{{$codigoverificacao}}</strong>.</small>
            </p>
           
        </div>
        <figure class="ml-3 mt-2">{!! QrCode::size(100)->generate(route('verificador', $codigoverificacao)) !!}
        </figure>        
    </div>
    <div class="row">
        <p><small>{{$iddocumento}}</small></p>
    </div>
</div>






