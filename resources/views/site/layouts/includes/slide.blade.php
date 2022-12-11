
    <!-- Main Carousel Section -->
    <div id="carousel-area  ">
        <div id="carousel-slider" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            @foreach($posts_destaque as $key => $noticia)
            <li data-target="#carousel-slider" data-slide-to="{{$loop->index}}" class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
          </ol>
          <div class="carousel-inner" role="listbox" style="height: 450px">
            @foreach($posts_destaque as $key => $noticia)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
              <img src="{{config('app.aws_url').$noticia->img_destaque }}" alt="{{$noticia->titulo}}"  style="width: 100%" >
              <div class="carousel-caption" style="margin-top: -50px">
                <h1>{{$noticia->titulo}}</h1>              
                <a href="{{route('noticias.show', $noticia->url)}}" class="btn btn btn-border">Leia Mais</a>
              </div>
            </div>
              
            @endforeach           
          </div>
          <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
            <i class="lnr  lnr-arrow-left"></i>
          </a>
          <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
            <i class="lnr  lnr-arrow-right"></i>
          </a>
        </div>
      </div>
  