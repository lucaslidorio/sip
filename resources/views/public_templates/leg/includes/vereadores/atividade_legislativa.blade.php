

   
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
        <a href="{{ route('camara.proposituras', ['autor' => $vereador->id, 'tipo' => $tipoId]) }}" class="list-group-item text" style="line-height:1.9 !important">
            {{ $proposicao['nome'] }}
            <span class="badge text-bg-secondary mt-1 float-end">{{ $proposicao['quantidade'] }}</span>
        </a>
       @endforeach
    </ul>
</div>
{{-- <div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Relatoria</h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item text-center text-muted">O vereador não possui relatoria cadastrada.</li>
    </ul>
</div> --}}
<div class="card mt-3">
    <div class="card-header cor-padrao-bg">
        <h5 class="card-title text-white fs-3">Pronunciamentos</h5>
    </div>

    <ul class="list-group list-group-flush">

        @if($pronunciamentos->isEmpty())
            <li class="list-group-item text-center text-muted">O vereador não possui pronunciamentos cadastrados.</li>
        @else
            @foreach($pronunciamentos->take(5) as $pronunciamento)
            <a href="{{ route('camara.pronunciamento.show', $pronunciamento->id) }}"class="list-group-item text" style="line-height:1.9 !important">
                {{ $pronunciamento->session->nome }} - {{ \Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y') }}
            </a>
                {{-- <li class="list-group-item">
                    <a href="{{ route('camara.pronunciamento.show', $pronunciamento->id) }}" class="text-decoration-none">
                        {{ $pronunciamento->session->nome }} - {{ \Carbon\Carbon::parse($pronunciamento->session->data)->format('d/m/Y') }}
                    </a>
                </li> --}}
            @endforeach

            @if($pronunciamentos->count() > 5)
                <li class="list-group-item text-center">
                    <a href="{{ route('camara.pronunciamentos', ['councilor_id' => $vereador->id]) }}" class="text-decoration-none">
                        Ver todos os pronunciamentos <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </li>
            @endif
        @endif
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
