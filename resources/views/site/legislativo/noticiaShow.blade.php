<style>
  .galeria {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.zoom {
  max-width: 100%;
  max-height: 100%;
  transition: all 0.3s ease-out;
}

.zoom:hover {
  transform: scale(2);
  z-index: 1;
}
</style>

@extends('site.legislativo.layouts.default')

 @section('content') 
 {{ Breadcrumbs::render('noticia', $post) }}       
            <div>
              @isset($post)
                <h4 class="font-blue" id="titulo">{{$post->titulo}}</h4> 
                <img src="{{config('app.aws_url').$post->img_destaque }}" class="img-fluid  float-start me-3" style="width:500; height:400px" alt="...">               
                <p>{!!$post->conteudo!!}</p>                
              @endisset             
            </div>
           
              <div class="container  mt-5 mb-5">
                <div class="galeria">
                @foreach ($post->imagens as $imagem) 
                <img src="{{config('app.aws_url')."{$imagem->img}" }}" class="zoom m-2" style= "width:200px" >        
                 
                 @endforeach
                </div>
              </div>
            
            <div class="row">
              <div class="col-md-12">
                <span class="fw-bold" >Compartilhar</span> <br>
                <a href="" id="whatsapp-share-btt" rel="nofollow" target="_blank"><i class="bi bi-whatsapp text-success fs-3"></i></a>
                <a href="" id="facebook-share-btt" rel="nofollow" target="_blank" class="facebook-share-button"><i class="bi bi-facebook fs-3"></i></a>

              </div>             
              
            </div>

           

           
@endsection

      <script>
        //Constrói a URL depois que o DOM estiver pronto compartilhamento whatsapp
        document.addEventListener("DOMContentLoaded", function() {
            //conteúdo que será compartilhado: Título da página + URL
            var titulo = document.getElementById("titulo").innerHTML;
            var conteudo = encodeURIComponent(titulo + " - "+ document.title + " " + window.location.href);
            //altera a URL do botão
            document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
            document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
        }, false);   

 let imagens = document.querySelectorAll('.zoom');
        
        for (let i = 0; i < imagens.length; i++) { imagens[i].addEventListener('click', function() {
          this.classList.toggle('expandir'); }); }

    
   </script>
