@extends('site.legislativo.layouts.default')

@section('content')
    <div class="row">
        <h4 class="font-blue text-uppercase">OUVIDORIA REGISTRADA COM SUCESSO</h4>
        <div class="col-12">
            <div class="alert alert-success" role="alert">
                <p>Solicitação protocolada com sucesso.</p>
                <h6>Salve o seu número de protocolo para acompanhar sua solicitação posteriormente.</h6>
                <h6><strong>Protocolo : </strong>{{$ouvidoria->codigo}}</h6>
            </div>
        </div>
    </div>
@endsection


