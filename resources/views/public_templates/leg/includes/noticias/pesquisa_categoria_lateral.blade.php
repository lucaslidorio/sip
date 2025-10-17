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
                <option value="" selected>Categorias</option>
                @foreach ($categorias as $item)
                    <option value="{{$item->id}}">{{$item->nome}}</option>
                @endforeach                           
            </select>                                           
       
        <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3">Pesquisar</button>
        </form>
    </div>
    
  </div>

  <div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">CATEGORIAS</h5>
    </div>
    <ul class="list-group list-group-flush">     
        @foreach ($categorias as $item)
        <a href="{{ route('noticias.todas', ['category_id' => $item->id]) }}" class="list-group-item  text " style="line-height:1.9 !important">{{$item->nome}} 
            <span class="badge  text-bg-secondary mt-1  float-end">{{$item->posts_count}} </span></a>
        @endforeach               
    </ul>
  </div>