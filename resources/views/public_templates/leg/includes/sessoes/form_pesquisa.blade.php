<div class="card mb-3" >
    <div class="card-header cor-padrao-bg" >
        <h5 class="card-title text-white fs-3">PESQUISE EM SESSÕES PLENÁRIAS</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{route('camara.sessoes') }}">
             @csrf
             <div class="row">
                 <div class="col-md-6">
                    <label for="vereador">Nome</label>
                     <div class="input-group input-group-lg">   
                        <input type="text" name="pesquisar" class="form-control" placeholder="Nome" aria-label="pesquisar" aria-describedby="pesquisar">
                    </div> 
                 </div>
                <div class="col-md-6">
                    <label for="type_session_id">Tipo</label>
                    <div class="input-group input-group-lg">
                        <select class="form-select form-select-lg mb-3" name="type_session_id" aria-label="Large select example">
                            <option value="" selected>Tipos de sessões </option>
                            @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ request('type_session_id')==$tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nome }}
                            </option>
                            @endforeach                    
                        </select>
                    </div> 
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <label for="legislature_id">Legislatura</label>
                    <div class="input-group input-group-lg">
                        <select name="legislature_id" class="form-select form-select-lg mb-3" >
                            <option value="">Todas</option>
                            @foreach($legislaturas as $legislatura)
                                <option value="{{ $legislatura->id }}" {{ request('legislature_id') == $legislatura->id ? 'selected' : '' }}>
                                    {{ $legislatura->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
             <div class="col-md-3">
                <label for="ano">Ano</label>
                   <div class="input-group input-group-lg">
                        <select name="ano" class="form-select form-select-lg mb-3">
                            <option value="">Todas</option>
                            @foreach($anos  as $ano)
                            <option value="{{$ano}}" {{request('ano') == $ano ? 'selected' : '' }}>
                                {{ $ano }}
                            </option>                    
                            @endforeach
                        </select>
                    </div>
             </div>
                    <div class="col-md-3">
                        <label for="situacao">Ordenar</label>
                        <div class="input-group input-group-lg">
                            <select name="ordenacao" class="form-control">
                                <option value="desc" {{ request('ordenacao')=='desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                <option value="asc" {{ request('ordenacao')=='asc' ? 'selected' : '' }}>↑ Crescente</option>
                            </select>
                        </div>
                
                    </div>
                </div>           
                  
        <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3">Pesquisar</button>
     </form>
    </div>
    
  </div>

 

<!-- Filtros -->