
@extends('public_templates.leg.default')
{{-- Efeito de imagens --}} 
<style>
     .glightbox-container .glightbox-desc{
         color: #fff;
        font-weight: 700;
        text-align: center;
        padding-bottom: 1rem;
     
    }
    .glightbox-container .glightbox-content {
        max-width: 80%; /* Define a largura máxima */
        max-height: 80vh; /* Define a altura máxima */
    }

    .glightbox-container .glightbox-image,
    .gslide-image img { /* Adicionando seletor mais específico */
       max-width: 80% !important;  /* A imagem não pode ser maior que o contêiner */
        max-height: 80% !important; /* A imagem não pode ser maior que o contêiner*/
        object-fit: contain !important; /* Garante que a imagem se encaixe completamente dentro do contêiner */
    }    
     
    .img-zoom-bounce {
        animation: zoomBounce 5s ease-in-out infinite;
        /* Combinação de efeitos */
    }
    @keyframes zoomBounce {
        0%,
        100% {
            transform: scale(1) translateY(0);
            /* Posição inicial */
        }
        50% {
            transform: scale(1.05) translateY(-5px);
            /* Zoom + movimento para cima */
        }
    }
    img.img-fluid {
    cursor: pointer;
    transition: transform 0.3s;

    
}

img.img-fluid:hover {
    transform: scale(1.05);
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
img.img-fluid {
    cursor: pointer;
    transition: transform 0.3s, box-shadow 0.3s;
}

img.img-fluid:hover {
    transform: scale(1.15);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
    
}

.row .col-md-3 a img {
    animation: pulse 2s ease-in-out infinite alternate; /* Aplica a animação */
    display: block;
}

@keyframes pulse {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.05);
    }
}
</style>



@section('content')

<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Noticias e informativos</p>
            </div>
            <div class="col-4">breadcump</div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-12 col-md-8">           
          <main class="py-4 me-4">                                    
                    <!-- Data e Categoria -->
                    <div class="mb-3">
                        @foreach ($noticia->categories as $item)
                        <span class="badge bg-info">{{$item->nome}}</span>
                        @endforeach                        
                        <span class="text-muted"> Publicado em: {{ \Carbon\Carbon::parse($noticia->data_publicacao)->translatedFormat('d \\d\\e F \\d\\e Y') }}
                        </span>
                    </div>

                    <!-- Título -->
                    <hr>
                    <h2 class="fw-bold mb-4" id="titulo">{{ $noticia->titulo }}</h2>         
                   
                    <!-- Conteúdo da Notícia -->
                    <article class="mb-5">                        
                        <img src="{{config('app.aws_url').$noticia->img_destaque }}" 
                        class="img-fluid  float-start me-3 img-zoom-bounce" style="width:400px; height:300px" title="{{$noticia->titulo}}" alt="{{$noticia->titulo}}">               
                        <p>{!!$noticia->conteudo!!}</p>
                    </article>                   

                    <section class="mb-5">
                        <h3 class="mb-3 fw-bold border-bottom">Galeria de Imagens</h3>
                      
                        <div class="row g-3">
                            @foreach ($noticia->imagens as $imagem)
                            <div class="col-3 col-md-3">
                                <!-- Link com atributos do Lightbox -->
                                <a href="{{config('app.aws_url').$imagem->img}}" class="glightbox" >
                                    <img src="{{config('app.aws_url').$imagem->img}}" 
                                        class="img-fluid rounded" 
                                        alt="{{$imagem->img}}"                                        
                                    >
                                </a>
                            </div> 
                            @endforeach
                        </div>                        
                    </section>
                    
                    

                    <!-- Botões de Compartilhamento -->
                    <section>
                        <h3 class="h5 mb-3">Compartilhe:</h3>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                               id="facebook-share-btt" 
                               class="btn btn-primary  text-white" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <i class="fab fa-facebook-square"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $noticia->titulo }}" 
                               id="twitter-share-btt" 
                               class="btn btn-info  text-white" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <i class="fab fa-twitter-square"></i> Twitter
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ $noticia->titulo }}%20{{ url()->current() }}" 
                               id="whatsapp-share-btt" 
                               class="btn btn-success  text-white" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                <i class="fab fa-whatsapp-square"></i> WhatsApp
                            </a>
                        </div>
                    </section>
               
            </main>
        </div>


        <div class="col-12 col-md-4">
            <div class="card" >
                <div class="card-header cor-padrao-bg" >
                    <h5 class="card-title text-white fs-3">PESQUISE EM NOTÍCIAS</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('noticias.todas')}}" method="get">
                        @csrf
                        <div class="input-group input-group-lg">
                            <span class="input-group-text" id="pesquisar"><i class="fa-solid fa-magnifying-glass"></i></span>
                            <input type="text" name="pesquisar" class="form-control" aria-label="pesquisar" aria-describedby="pesquisar">
                        </div>                 
                        
                        <div class="input-group input-group-lg mt-3 mb-3">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" name="data_publicacao_inicial" class="form-control" placeholder="Username" aria-label="Username">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                            <input type="date" name="data_publicacao_final" class="form-control" placeholder="Server" aria-label="Server">
                        </div> 
                        <select class="form-select form-select-lg mb-3" name="category_id" aria-label="Large select example">
                            <option selected>Categorias</option>
                            @foreach ($categorias as $item)
                                <option value="{{$item->id}}">{{$item->nome}}</option>
                            @endforeach                           
                        </select>                                              
                   
                    <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3">Pesquisar</button>
                    </form>
                </div>
                
              </div>

              <div class="card MT-3">
                <div class="card-header cor-padrao-bg">
                    <h5 class="card-title text-white fs-3">CATEGORIAS</h5>
                </div>
                <ul class="list-group list-group-flush">     
                    @foreach ($categorias as $item)
                    <a href="#" class="list-group-item  text " style="line-height:1.9 !important">{{$item->nome}} 
                        <span class="badge  text-bg-secondary mt-1  float-end">{{$item->posts_count}} </span></a>
                    @endforeach               
                </ul>
              </div>

           
        </div>        
    </div>
</div>


@endsection



<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            console.log('GLightbox: Inicialização iniciada');
            const lightbox = 
            GLightbox({ 
                selector: '.glightbox', 
                touchNavigation: true, 
                loop: true ,
                openEffect: 'zoom', // Efeito de zoom ao abrir
                closeEffect: 'fade' // Efeito de fade ao f
            });                   
        });

        //Constrói a URL depois que o DOM estiver pronto compartilhamento whatsapp
        document.addEventListener("DOMContentLoaded", function() {
            //conteúdo que será compartilhado: Título da página + URL
            var titulo = document.getElementById("titulo").innerHTML;
            var conteudo = encodeURIComponent(titulo + " - "+ document.title + " " + window.location.href);
            //altera a URL do botão
            document.getElementById("whatsapp-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo;
            document.getElementById("twitter-share-btt").href = "https://api.whatsapp.com/send?text=" + conteudo
            document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
        }, false);  
    </script>




