<!doctype html>
<html class="no-js" lang="zxx">
    @include('site.executivo.includes.head')
    <style>
        img{
            max-width:426px;
            max-height:312px;
            width: auto;
            height: auto;
        }

    </style>
<body>
    <header>
        <div class="header-area">
            <div class="main-header ">
                @include('site.executivo.includes.header-top')
                @include('site.executivo.includes.menu')                
            </div>
        </div>
    </header>
    <main>
        <!-- Hero area Start-->
        <div class="slider-area">
            <div class="slider-height2 slider-bg6 hero-overly02 d-flex align-items-center">
                <div class="container">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-6">
                            <div class="hero-caption hero-caption2 text-center">
                                <h2>Noticias</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--  Hero area End -->
        <!-- location-house start -->
        <div class="location-house ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-60">
                            <h2>Utimas noticias ->
                                 @isset($categoria)
                                  {{$categoria->nome}}
                                @endisset</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-project project mb-30">
                            <img src="{{config('app.aws_url')."{$post->img_destaque}" }}" 
                            alt="" class="w-100 img-fluid">
                            <figcaption class="figure-caption">
                                Publicado em: {{\Carbon\Carbon::parse($post->data_publicacao)->format('d/m/Y')}} = {{$post->id}}
                            </figcaption>
                           
                            <div class="project-contents">
                                <h3><a href="#">{{$post->titulo}}</a></h3>
                                {{-- <p>{{$item->titulo}}</p> --}}
                                <a href="{{route('noticia.show', $post->url)}}" class="border-btn">Leia Mais</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div> 
        <!-- location-hou-->
    </main>
    @include('site.executivo.includes.footer')
   <!-- footer-bottom area -->
   <div class="footer-bottom-area">
       <div class="container">
           <div class="footer-border">
               <div class="row d-flex align-items-center">
                   <div class="col-xl-12 ">
                       <div class="footer-copy-right">
                           <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Todos os direitos reservados  <i class="fa fa-heart color-danger" aria-hidden="true"></i> Desenvolvido por <a href="https://fpstecnologia.com.br/" target="_blank" rel="nofollow noopener">FPS Tecnologia</a></p>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
</footer>
<!-- Scroll Up -->
<div id="back-top" >
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>
<!--? Search model Begin -->
<div class="search-model-box">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Searching key.....">
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- JS here -->
@include('site.executivo.includes.js')
</body>
</html>