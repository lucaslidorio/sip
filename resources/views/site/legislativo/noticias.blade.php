
@extends('site.legislativo.layouts.default')

 @section('content')   
 {{ Breadcrumbs::render('noticias') }}    
 <div class="row justify-content-md-center">
  <div class="col-md-12">          
    <div class="blog-post">        
      <div class="post-thumb">
        {{-- <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid" alt="Responsive image" style="max-height: 500px" alt="{{$post->titulo}}"> --}}
      </div>
      <div class="post-content">
       {{-- <form action="{{route('noticiasTodas.pesquisar')}}" method="get">
        <div class="input-group mb-3">
          <input type="text" name="pesquisa" class="form-control p-4" placeholder="Digite aqui..." aria-label="Digite aqui" aria-describedby="botão de pesquisar noticias">
          <div class="input-group-append">
            <button class="btn  btn-outline-primary text-primary" type="submit" id="btnPesquisar"> 
              <i class="fas fa-search "></i>
              Pesquisar</button>
          </div>
        </div>
       
       </form> --}}
       <form action="{{ route('noticias.todas') }}" method="get">
       <div class="row">
        <div class="input-group mb-3">
          <input type="text" id="pesquisar" name="pesquisar" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="pesquisar">
          <button class="btn btn-outline-secondary" type="submit" id="btnPesquisar"><i class="bi bi-search"></i> Pesquisar</button>
        </div>
       </div>
       </form>


       <div class="row">
         <div class="col-12 ">
          <ul class="list-unstyled ">
            @foreach ($posts as $noticia) 
            <a href="{{route('noticias.show',$noticia->url) }}" class="text-decoration-none">                         
            <div class="d-flex text-body-secondary pt-3 " >      
              <img src="{{config('app.aws_url').$noticia->img_destaque }}" class="figure-img img-fluid me-3 " alt="..." width="100px" height="100px">        
              {{-- <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg> --}}
              <div class="row">
                <h5 class="text-dark" >{{$noticia->titulo}}</h5>
                <h6 class="text-secondary">{!!$noticia->conteudo_trucado!!} </h6>
              <span class="pb-3 mb-0 small lh-sm border-bottom">
                <br>                     
               <span class="text-muted">
                  Publicado por:
                  <i class="lnr lnr-user "></i> {{$noticia->user->name}}
                </span>
                <span class="text-muted">
                  <i class="lnr lnr-calendar-full"></i>
                  {{Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}
                </span>
              </span>
              </div>
              
                
            </div>
          </a>   
            @endforeach
          </ul>                
           
         </div>
   
       </div>
       @if (!empty($pesquisar))
       {!!$posts->appends($pesquisar)->links()!!}
       @else
       {!!$posts->links()!!}
       @endif
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
