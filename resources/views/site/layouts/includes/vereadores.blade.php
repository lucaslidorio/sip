<section id="vereadores" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title"> <span>Vereadores</span></h2>
      <hr class="lines">
      <p class="section-subtitle">{{$legislature->descricao}}</p>      
    </div>
    <div class="row justify-content-center">  
        
      @foreach ($councilors as $vereador)
      <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="single-team mb-4">
         <a href="#"> <img src="{{config('app.aws_url').$vereador->img }}" alt=""></a>
          <div class="team-details">
            <div class="overlay"></div>
            <div class="team-inner">
              <a href="{{route('vereadores.show', $vereador->nome)}}" class=""><h4 class="team-title">  {{$vereador->nome}} - {{$vereador->party->sigla}}</h4></a>
              {{-- <ul class="social-list">
                <li class="facebook"><a target="_blank" href="{{$vereador->facebook}}"><i class="fa fa-facebook"></i></a></li>
                <li class="instagram"><a target="_blank" href="{{$vereador->instagram}}"><i class="fa fa-instagram"></i></a></li>
              </ul> --}}
            </div>
          </div>
        </div>
      </div>     
      @endforeach          
    </div>
  </div>
</section>