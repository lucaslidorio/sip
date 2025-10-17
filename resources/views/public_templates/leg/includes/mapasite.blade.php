@extends('public_templates.leg.default')

@section('content')

<div class="container">
  <h2 class="mb-4 fs-2">Mapa do site</h2>



<p class="fs-3"> Uma visão geral do conteúdo disponível no site. </p>
<div class="row fs-3">
    @foreach ($menus as $menu)                                      
            <li class="mb-1 bg-color-0">             
                {{$menu->nome}}              
                 @if(count($menu->submenu) > 0 )                 
                  <ul>                    
                    @foreach ($menu->submenu as $item)                   
                      @if ($item->pagina_interna == 1 && $item->url == null)
                        <li><a href="{{route('pagina', $item->slug)}}" >{{$item->nome}}</a></li>
                      @elseif($item->pagina_interna == 1 && $item->url != null)
                       <li><a href="{{route($item->url)}}" >{{$item->nome}}</a></li>
                      @else
                        <li><a href="{{$item->url}}" target="{{$item->target ? '__blank': ''}}" >{{$item->nome}}</a></li>
                      @endif                                           
                  @endforeach                   
                  </ul>
                    
                 @endif                                
             </li>                                
    @endforeach
</div>
</div>


@endsection