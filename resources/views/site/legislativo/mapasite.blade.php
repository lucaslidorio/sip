@extends('site.legislativo.layouts.default')

@section('content')
<h3 class="font-blue text-center">Mapa do site</h3>
<p>Uma visão geral do conteúdo disponível no site. Mantenha o ponteiro do mouse sobre o item por alguns segundos para visualizar sua descrição.</p>
<div class="row">
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
<div class="row">
    <li>
        Link Úteis
        <ul>
            @foreach ($linksUteis as $link)
            <li class="mb-1 ">
                <a target="{{$link->target ? '_blank' : ''}}" href="{{$link->url}}">{{$link->nome}}</a>
            </li>
            @endforeach
    </li>
    </ul>
    </li>
</div>
<div class="row">
    <li>
        Servços Online
        <ul>
        @foreach ($linksDireita as $link)
            <li class="mb-1 ">
                <a target="{{$link->target ? '_blank' : ''}}" href="{{$link->url}}">{{$link->nome}}</a>
            </li>
        @endforeach
    </li>
    </ul>
    </li>
</div>
<div class="row">
    <li>        
        <ul>
            <li class="mb-1 ">
                <a href="{{route('pagina',  'contato')}}">Contato</a>
            </li>
            <li class="mb-1 ">
                <a href="/">Página Inicial</a>
            </li>
            <li class="mb-1 ">
                <a href="{{route('ouvidoriaSite.index')}}">Ouvidoria</a>
            </li>
            <li class="mb-1 ">
                <a href="{{route('ouvidoriaSite.index')}}">Perguntas Frequentes</a>
            </li>
            <ul>      
                    
    </li>  
</div> 
@endsection

