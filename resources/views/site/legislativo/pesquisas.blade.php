
@extends('site.legislativo.layouts.default')

@section('content')       
<div class="row justify-content-md-center">
 <div class="col-md-12">          
   <div class="blog-post">        
     <div class="post-thumb">
       {{-- <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid" alt="Responsive image" style="max-height: 500px" alt="{{$post->titulo}}"> --}}
     </div>
     <div class="post-content">     
      <form action="{{ route('site.pesquisar') }}" method="get">
        <div class="row">
         <div class="input-group mb-3">
           <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="pesquisar">
           <button class="btn btn-outline-secondary" type="submit" id="btnPesquisar"><i class="bi bi-search"></i> Pesquisar</button>
         </div>
        </div>
        </form>


      <div class="row">
        <div class="col-12">
         <ul class="list-unstyled ">
          @if($resultados->isEmpty())
          <p>Nenhum resultado encontrado.</p>
          @else          
            @foreach($resultados as $resultado)
            <a href="{{$resultado['url']}}" class="text-decoration-none">                         
              <div class="d-flex text-body-secondary pt-3 " >      
              <div class="row">
                  <h5 class="text-dark" >{{ $resultado['tabela'] }}</h5>
                  <h6 class="text-secondary">{{ $resultado['nome'] }}</h6>
                 
                  <h6 class="text-secondary">{{ $resultado['titulo'] }}</h6>
                  <span class="pb-1 mb-0  border-bottom">
                    {{-- <h6 class="">{!!$resultado['conteudo'] !!}</h6> --}}
                    <p class="">{{ $resultado['descricao'] }}</p> 
                    <p class="">{{ $resultado['biografia'] }}</p>     
                    <p class="">{{ $resultado['caput'] }}</p>                    
                  </span>                 
                </div>             
                
              </div>
            </a>
            @endforeach             
       
          @endif
         </ul>                
          
        </div>
  
      </div>
      
     </div>            
     <div class="container mt-5 mb-5">
       
       {{-- @foreach ($post->imagens as $imagem)         
         <a class="galeria_post" href="{{config('app.aws_url')."{$imagem->img}" }}" title="">
           
           <img src="{{config('app.aws_url')."{$imagem->img}" }}" class="" style= "width:200px" >
         </a>  
        @endforeach --}}
     </div>          
   </div>
 </div>         
</div> 

          

          
@endsection
