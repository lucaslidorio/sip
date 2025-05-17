<div class="card mb-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">PESQUISE EM PARECERES</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('camara.pareceres') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="comissao" class="form-label">Comissão</label>
                <div class="input-group input-group-lg">
                    <select class="form-select form-select-lg " id="comissao" name="comissao">
                        <option value="">Todas</option>
                        @foreach($comissoes as $comissao)
                        <option value="{{ $comissao->id }}" {{ request('comissao')==$comissao->id ? 'selected' : '' }}>
                            {{ $comissao->nome }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="assunto" class="form-label">Assunto</label>
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" id="assunto" name="assunto"
                        value="{{ request('assunto') }}">
                </div>
            </div>

            <div class="col-md-2">
                <label for="data_inicial" class="form-label">De</label>
                <div class="input-group input-group-lg">
                    <input type="date" class="form-control" id="data_inicial" name="data_inicial"
                        value="{{ request('data_inicial') }}">
                </div>
            </div>

            <div class="col-md-2">
                <label for="data_final" class="form-label">Até</label>
                <div class="input-group input-group-lg">
                    <input type="date" class="form-control" id="data_final" name="data_final"
                        value="{{ request('data_final') }}">
                </div>
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3  me-3 fs-3">Pesquisar</button>
            </div>
        </form>

    </div>

</div>



<!-- Filtros -->