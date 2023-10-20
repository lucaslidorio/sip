
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
            <div class="carousel-item {{ $loop->first ? 'active' : '' }} w-100 h-100">
              <img src="{{config('app.aws_url').$noticia->img_destaque }}" alt="{{$noticia->titulo}}"  
              class="w-100 h-100" >
              <div class="carousel-caption" style="margin-top: -50px">
                <h5 class="text-uppercase font-weight-bold    "
                style="text-shadow: #fff -1px 2px 2px; color:black">
                  {{$noticia->titulo}}</h5>              
                <a href="{{route('noticias.show', $noticia->url)}}" 
                  class="btn btn-border font-weight-bold  "
                  style="box-shadow: -4px 2px 2px 1px rgba(0, 0, 0, 0.2); color:black">
                  Leia Mais</a>
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
  