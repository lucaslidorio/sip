
@extends('site.legislativo.layouts.default')

 @section('content')
 {{ Breadcrumbs::render('home') }}
        <div class="row mb-2" >
          @foreach ($linksTopo as $link)
            <div class="col-sm-6 col-md-3 mb-sm-2 banner" >
              
              <a href="{{$link->url}}" target="{{$link->target ==1 ? '__blank': ''}}" class="">
                <img  src="{{config('app.aws_url').$link->icone }}" class="img-fluid w-100 h-75 " alt="{{$link->nome}}" >
              </a>            
            </div>
          @endforeach
        </div>       
            <div id="carouselDestaque" class="carousel carousel-dark slide shadow p-3 mb-4 bg-body rounded "
              data-bs-ride="carousel">
              <div class="carousel-indicators">
             @foreach($posts_destaque as $key => $noticia)
                
                <button type="button" data-bs-target="#carouselDestaque" data-bs-slide-to="{{$loop->index}}"
                  class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide 1"></button>
                @endforeach
                </div>
                <div class="carousel-inner">
                  @foreach($posts_destaque as $key => $noticia)
                  <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="10000" style="height: 500px;">
                   <a href="{{route('noticias.show',$noticia->url) }}">
                    <img src="{{config('app.aws_url').$noticia->img_destaque }}" class="d-block w-100 h-100 img-fluid "
                      alt="{{$noticia->titulo}}">
                    <div class="carousel-caption d-none d-md-block">
                      <h2>{{$noticia->titulo}}</h2>                   
                    </div>
                  </a>
                  </div>
                  @endforeach
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselDestaque" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselDestaque" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
              </button>
            </div>

          {{-- Banner abaixo do  Slide --}}
            <div class="row">
              @foreach ($linksInferior as $link)
                <div class="col-sm-4 col-md-4 mb-sm-2 banner" >
                  <a href="{{$link->url}}" target="{{$link->target ==1 ? '__blank': ''}}" class="">
                    <img  src="{{config('app.aws_url').$link->icone }}" class="img-fluid w-100 h-75 " alt="{{$link->nome}}" >
                  </a>            
                </div>
              @endforeach
            </div>


            <div class="row">
              <div class="col-md-6">
                <h4 class="font-blue">Últimas Notícias</h4>
                @foreach ($ultimasNoticias as $noticia)
                <a href="{{route('noticias.show', $noticia->url)}}" class="text-decoration-none" >
                  <div class="row p-2 link">
                    <div class="container ">
                      <img src="{{config('app.aws_url').$noticia->img_destaque }}" alt="" class="img-fluid  float-start me-3" style="width:130px; height:100px" >
                      <p class="fw-lighter text-dark">{{\Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</p>
                      <h6 class="text-dark ">{{$noticia->titulo}}</h6>                
                    </div>
                  </div>
                </a>            
                @endforeach 
              </div>
              <div class="col-md-6">
                <h4 class="font-blue">Enquete</h4>
                @if($enquete)
                <form action="{{ route('enquete.votar', $enquete->id) }}" method="post">
                    @csrf
                    <h6 class="text-dark">{{ $enquete->nome }}</h6>
        
                    @foreach($enquete->itens as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="item_id" id="item{{ $item->id }}" value="{{ $item->id }}">
                            <label class="form-check-label" for="item{{ $item->id }}">
                                {{ $item->nome }}
                            </label>
                        </div>
                    @endforeach
        
                    <button type="submit" class="btn btn-primary mt-3">Votar</button>
                </form>
            @else
                <p>Nenhuma enquete ativa no momento.</p>
            @endif
              </div>
            </div>
            
                   
      @endsection