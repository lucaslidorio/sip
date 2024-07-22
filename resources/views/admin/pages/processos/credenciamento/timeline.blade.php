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
  <div class="card-header">
    <h4>Informações do Processo</h4>
  </div>
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
      <p class="card-text"><strong>Data de Validade : </strong> {{$processo->data_validade->format('d-m-Y H:i:s')}}</p>
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
  <div class="card ">
    <div class="card-header">
      <h5> <strong>Dados do Credenciado</strong></h5>
    </div>
    <div class="row no-gutters " style="padding:15px">
      <div class="col-md-3" style="padding-left: 15px">
        <p class="card-text"><strong> Razão Social: </strong>{{$credenciamento->dadoPessoa->razao_social}}</p>
        <p class="card-text"><strong>Enquadramento: </strong>{{$credenciamento->dadoPessoa->enquadramento}}</p>
       
      </div>
      <div class="col-md-3" style="padding-left: 15px">
        <p class="card-text"><strong>Cnpj: </strong> {{$credenciamento->dadoPessoa->cnpj}}
        </p>
        <p class="card-text"><strong>Natureza Jurídica : </strong> {{$credenciamento->dadoPessoa->natureza_juridica}}</p>
      </div>
      <div class="col-md-3" style="padding-left: 15px">
        <p class="card-text"><strong>Insc. Estadual: </strong> {{$credenciamento->dadoPessoa->inscricao_estadual}}</p>
        <p class="card-text"><strong>Contato: </strong> {{$credenciamento->dadoPessoa->celular}} / {{$credenciamento->dadoPessoa->telefone}}</p>
       
      </div> 
      <div class="col-md-3" style="padding-left: 15px">
        <p class="card-text"><strong>Data de Abertura : </strong> {{$credenciamento->dadoPessoa->data_abertura->format('d-m-Y')}}</p>
       
      </div>  
    </div>
    <div class="row no-gutters border-bottom " style="padding-left:15px; padding-bottom:15px">
      <div class="col-12" style="padding-left: 15px">
      <p class="card-text"><strong>Endereço: </strong> 
        {{$credenciamento->dadoPessoa->endereco}}
        {{$credenciamento->dadoPessoa->numero}}
        {{$credenciamento->dadoPessoa->bairro}}
        {{$credenciamento->dadoPessoa->cidade}}
        {{$credenciamento->dadoPessoa->estado}}
      </p>
      </div>
    </div>
  </div>
      <div class="row no-gutters " style="padding:15px">
        <div class="col-md-12">          
          <div class="timeline">
            @foreach($movimentacoesPorData as $data => $movimentacoes)
                <div class="time-label">
                    <span class="bg-primary">{{ \Carbon\Carbon::parse($data)->format('d M. Y') }}</span>
                </div>
                @foreach($movimentacoes as $movimentacao)
                    <div>
                  @switch($movimentacao->tipo_movimentacao_id)
                  @case(1)
                      <i class="fas fa-shopping-cart bg-teal"></i>
                      @break
                  @case(2)
                      <i class="far fa-paper-plane bg-teal"></i>
                      @break
                  @case(3)
                      <i class="fas fa-download bg-blue "></i>
                      @break
                  @case(4)
                      <i class="far fa-question-circle bg-warning "></i>
                      @break
                  @case(5)
                      <i class="fas fa-check-square bg-green "></i>
                      @break
                  @case(6)
                      <i class="fas fa-pause-circle bg-orange "></i>
                      @break
                  @case(7)
                      <i class="fas fa-hand-paper bg-danger "></i>
                      @break 
                  @case(8)
                      <i class="far fa-times-circle bg-danger "></i>
                      @break    
                  @case(9)
                      <i class="far fa-paper-plane bg-teal"></i>
                      @break
                 
                  @default
                  <i class="fas fa-chevron-circle-down bg-blue"></i>
                  @endswitch




                        
                        
                        
                        <!-- Você pode alterar o ícone conforme a necessidade -->
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{ $movimentacao->created_at->format('H:i') }}</span>
                            <h3 class="timeline-header"><a href="#">{{ $movimentacao->user->name }}</a> {{ $movimentacao->tipoMovimentacao->nome }}</h3>
                            <div class="timeline-body">
                                {{ $movimentacao->observacao }} <!-- Aqui você pode ajustar para mostrar outras informações relevantes -->
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach    
            <div>
                <i class="fas fa-clock bg-gray"></i>
            </div>
        </div>
          {{-- <div class="timeline">  
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
              </div>
            </div>
            <div>
              <i class="fas fa-clock bg-gray"></i>
            </div>
          </div> --}}
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