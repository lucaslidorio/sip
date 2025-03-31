

   
  <div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">ATIVIDADES LEGISLATIVAS</h5>
    </div>
  
  </div>

  <div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Proposituras (Projetos)</h5>
    </div>
    <ul class="list-group list-group-flush">
        @foreach($proposituras as $tipoId => $proposicao)
        <a href="{{ route('camara.proposituras', ['vereador' => $vereador->id, 'tipo' => $tipoId]) }}" class="list-group-item text" style="line-height:1.9 !important">
            {{ $proposicao['nome'] }}
            <span class="badge text-bg-secondary mt-1 float-end">{{ $proposicao['quantidade'] }}</span>
        </a>
       @endforeach
    </ul>
</div>
<div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Relatoria</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center text-muted">O vereador não possui relatoria cadastrada.</li>
    </ul>
</div>
<div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Pronunciamentos</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center text-muted">O vereador não possui pronunciamento cadastrado.</li>
    </ul>
</div>
<div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Participações em Comissões</h5>
    </div>
    <ul class="list-group list-group-flush">
        @if($comissoes->isEmpty())
        <li class="list-group-item text-center text-muted">O vereador não faz parte de nenhuma comissão.</li>
        @else
            @foreach($comissoes as $comissao)
                <a href="#" class="list-group-item text" style="line-height:1.9 !important">
                    {{ $comissao['nome'] }} - <span class="text-muted">{{ $comissao['funcao'] }}</span>
                </a>
            @endforeach
        @endif
    </ul>
</div>
