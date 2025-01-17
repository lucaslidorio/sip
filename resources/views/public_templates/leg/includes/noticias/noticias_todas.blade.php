@extends('public_templates.leg.default')

@section('content')

<style>
    .row.mb-3 a {
    display: block; /* Garante que o link cobre toda a área do conteúdo */
    transition: transform 0.3s ease, background-color 0.3s ease; /* Suaviza o zoom e outras transições */
    background-color: transparent; /* Remove o fundo cinza inicial */
}

.row.mb-3 a:hover {
    transform: scale(1.03); /* Aumenta ligeiramente o tamanho do link */
    background-color: transparent; /* Mantém o fundo transparente no hover */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Adiciona uma sombra para destacar */
}

</style>
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
        @foreach ($noticias as $noticia)      
        <div class="row mb-3 ">
            <a href={{route('noticias.show',$noticia->url) }} class="text-decoration-none text-body">
                <div class="col-md-3 float-start">
                    <img src="{{config('app.aws_url').$noticia->img_destaque}}" width="100%" height="100%"
                    alt="" class="img-responsive" />
                </div>
                <div class="col md-9">
                    <h5><strong>{{Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</strong> - {{$noticia->titulo}}</h5>
                    <p id="limiteLinha">                        
                        {!! Str::limit(strip_tags($noticia->conteudo), 250, '...') !!}
                    </p>
                </div>
            </a>
        </div>
      @endforeach                   

                                    
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const paragrafo = document.getElementById("limiteLinha");
        const maxPalavras = 50;        
                if (paragrafo) {
            const palavras = paragrafo.textContent.trim().split(/\s+/);
            
            console.log(palavras);
            if (palavras.length > maxPalavras) {
                const textoTruncado = palavras.slice(0, maxPalavras).join(" ") + "...";
                paragrafo.textContent = textoTruncado;
            }
        }
    });
</script>
@endsection







