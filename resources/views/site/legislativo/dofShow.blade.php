
@extends('site.legislativo.layouts.default')

@section('content')
{{Breadcrumbs::render('diario_oficial_publicacao', $documento)}}
    <div class="card rounded-0">
      <div class="card-body">
        <ul class="list-unstyled">
          <li>
            <strong>Titulo:</strong> {{$documento->titulo}}
          </li>
          <li>
            <strong>Data Publicação:</strong> {{ date('d/m/Y', strtotime($documento->data_publicacao)) }}
          </li>
          <li>
            <strong>Tipo de Matéria:</strong> {{$documento->tipoMateria->nome}}
          </li>
          <li>
            <strong>Sub tipo de Matéria:</strong> {{$documento->subTipoMateria->nome}}
          </li>
          <li>
            <strong>Conteúdo:</strong>
            <p class="text-justify">{!!$documento->conteudo!!}</p>
          </li>
        </ul>

      </div>
      <div class="card-footer">
        <div class="row">         
          <div class="col-md-12">
            <div class="text-end">
              <small><strong>Criado por: </strong><small>{{$documento->user->name}} <strong>em </strong> {{
                  $documento->created_at }}</small></small> <br>
              <small><strong>Útima alteração por: </strong>{{$documento->userLastUpdate->name}} <strong>em </strong> {{
                $documento->updated_at }} </span></small>
            </div>
          </div>
        </div>
        @if($documento->assinaturas->count() > 0)
        <x-assinatura-site :assinaturas="$documento->assinaturas->where('status', true)" :municipio="config('app.municipio')"
          :codigoverificacao="$documento->codigo_verificacao" :iddocumento="$documento->uuid" />
        @endif
      </div>
    </div>

 
</section>
@endsection