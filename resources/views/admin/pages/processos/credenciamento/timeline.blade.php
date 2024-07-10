@extends('adminlte::page')

@section('title', "Acompanhamento de credenciamento")

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Acompanhamento de credenciamento processo nº - <strong>{{$processo->numero}}/
          {{$processo->data_publicacao->year}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
        <li class="breadcrumb-item ">Timeline</li>
      </ol>
    </div>
  </div>
</div>
@include('sweetalert::alert')
@stop

@section('content')

<div class="card mb-3 mt-3">
  <div class="row no-gutters border-bottom " style="padding:15px">
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
      <p class="card-text"><strong>Modalidade: </strong>
        {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
      <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>
      <td>
    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d-m-Y H:i:s')}}
      </p>
      <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Início da Sessão : </strong> {{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</p>
      <p class="card-text"><strong>Situação : </strong><span class="badge 
        @switch($processo->situacao->id)
        @case(32)
            badge-info
            @break
        @case(33)
            badge-success
            @break
        @case(34)
        @case(35)
            badge-info
            @break
        @case(34)
            badge-info
            @break
        @case(36)
            badge-warning
            @break
        @case(37)
        @case(38)
            badge-danger
            @break
        @default
            badge-secondary
      @endswitch">{{$processo->situacao->nome}} </span> </p>

    </div>  
  </div>


      <div class="row no-gutters " style="padding:15px">
        <div class="col-md-12">
  
          <div class="timeline">
  
            <div class="time-label">
              <span class="bg-red">10 Feb. 2014</span>
            </div>
  
  
            <div>
              <i class="fas fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-sm">Read more</a>
                  <a class="btn btn-danger btn-sm">Delete</a>
                </div>
              </div>
            </div>
  
  
            <div>
              <i class="fas fa-user bg-green"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
              </div>
            </div>
  
  
            <div>
              <i class="fas fa-comments bg-yellow"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                <div class="timeline-body">
                  Take me to your leader!
                  Switzerland is small and neutral!
                  We are more like Germany, ambitious and misunderstood!
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-warning btn-sm">View comment</a>
                </div>
              </div>
            </div>
  
  
            <div>
              <i class="fas fa-clock bg-gray"></i>
            </div>
          </div>
        </div>
  
      </div>
   
  






















  <div class="card-footer" style="padding-left: 34px">
 
     
  </div>
</div>


@section('js')
<script>
  //inicia o tooltip
  $(function () {
   $('[data-toggle="tooltip"]').tooltip()
  })  

</script>

@endsection

@stop