<div class="card mb-3" >
    <div class="card-header cor-padrao-bg" >
        <h5 class="card-title text-white fs-3">PESQUISE PRONUNICIAMENTOS</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{route('camara.pronunciamentos') }}">
             @csrf
             <div class="row">
                <div class="col-md-4">
                    <label for="vereador">Vereador </label>
                    <div class="input-group input-group-lg">
                        <select name="councilor_id" class="form-select">
                            <option value="">Todos os Vereadores</option>
                            @foreach($vereadores as $vereador)
                                <option value="{{ $vereador->id }}" {{ request('councilor_id') == $vereador->id ? 'selected' : '' }}>
                                    {{ $vereador->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>                 
                  
                </div>
                <div class="col-md-4">
                    <label for="vereador">Sessão </label>
                    <div class="input-group input-group-lg">
                        <select name="session_id" class="form-select">
                            <option value="">Todas as Sessões</option>
                            @foreach($sessoes as $sessao)
                                <option value="{{ $sessao->id }}" {{ request('session_id') == $sessao->id ? 'selected' : '' }}>
                                    {{ $sessao->nome }} - {{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col md-4">
                    <label for="vereador">Palavra Chave</label>
                        <div class="input-group input-group-lg">
                            <input type="text" name="pesquisa" value="{{ request('pesquisa') }}" class="form-control" placeholder="Buscar no discurso...">
                          
                        </div>
                   
                </div>
             </div>
             



             <div class="row">
                
                <div class="col-md-6">
                   
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                   
                </div>
             <div class="col-md-3">
                
             </div>
                   
                </div>           
                  
        <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3">Pesquisar</button>
     </form>
    </div>
    
  </div>

 

<!-- Filtros -->