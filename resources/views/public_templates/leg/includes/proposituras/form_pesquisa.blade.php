<div class="card mb-3" >
    <div class="card-header cor-padrao-bg" >
        <h5 class="card-title text-white fs-3">PESQUISE EM PROPOSITURAS</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{route('camara.proposituras') }}">
             @csrf
             <div class="row">
                 <div class="col-md-6">


                    <label for="vereador">Vereador:</label>
                     <div class="input-group input-group-lg">   
                        <select class="form-select form-select-lg mb-3" name="vereador" aria-label="Large select example">
                            <option value="" selected>VEREADORES </option>
                            @foreach ($vereadores as $vereador)
                            <option value="{{ $vereador->id }}" {{ request('vereador') == $vereador->id ? 'selected' : '' }}>
                                {{ $vereador->nome }}
                            </option>
                            @endforeach                           
                        </select></div> 
                 </div>

                <div class="col-md-6">
                    <label for="tipo">Tipo de Propositura</label>
                    <div class="input-group input-group-lg">
                        <select class="form-select form-select-lg mb-3" name="tipo" aria-label="Large select example">
                            <option value="" selected>TIPOS DE PROPOSITURAS </option>
                            @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" {{ request('tipo')==$tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nome }}
                            </option>
                            @endforeach                    
                        </select>
                    </div> 
                </div>
             </div>
             <div class="row">
                <div class="col-md-6">
                    <label for="situacao">Situação</label>
                    <div class="input-group input-group-lg">
                        <select name="situacao" class="form-select form-select-lg mb-3" >
                            <option value="">Todas</option>
                            @foreach($situacoes as $situacao)
                                <option value="{{ $situacao->id }}" {{ request('situacao') == $situacao->id ? 'selected' : '' }}>
                                    {{ $situacao->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
             <div class="col-md-3">
                    <label for="ano">Ano</label>
                    <div class="input-group input-group-lg">
                        <select name="ano" class="form-select form-select-lg mb-3">
                            <option value="" selected>Selecione</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>                    
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