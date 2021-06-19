<style>
    #btnVer:hover{
   color: white !important;   
   }
</style>

<section id="blog" class="section">
  <div class="container">
      <div class="section-header">
          <h2 class="section-title">Utimas <span>Notícia</span></h2>
          <hr class="lines">
          <p class="section-subtitle"></p>
      </div>
      <div class="row">
        
        @foreach ($posts as $noticia)   
        <div class="col-lg-4 col-md-6 blog-item">
            <div class="blog-item-wrapper mb-5">
                <div class="blog-item-img">
                    <a href="single-post.html">
                        <img src="{{config('app.aws_url').$noticia->img_destaque }}" alt="" style="max-height: 300px;">
                    </a>
                </div>
                <div class="blog-item-text">
                    <h3>
                        <a href="{{route('noticias.show', $noticia->url)}}">{{$noticia->titulo}}</a>
                    </h3>
                    <div class="meta-tags">
                        <span class="date"><i class="lnr lnr-calendar-full"></i>
                          {{\Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</span>
                        {{-- <span class="comments"><a href="#"><i class="lnr lnr-bubble"></i> 24 Comments</a></span> --}}
                    </div>
                    <a href="{{route('noticias.show', $noticia->url)}}" class="btn btn-common btn-rm">Leia Mais</a>
                </div>
            </div>
        </div>
            
        @endforeach
        
      </div>
      <div class="row text-center">
       <div class="col text-center font-weid">
          
        <a href="{{route('noticias.todas')}}" class="btn btn-outline-primary btn-lg text-primary"
          id="btnVer" >Ver Todas as Noticias</a>
       </div>
      </div>
  </div>
</section>