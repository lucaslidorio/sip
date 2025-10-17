{{-- resources/views/public_templates/gov/pesquisa/categoria.blade.php --}}

@foreach($items as $item)
<div class="search-result-item">
    <div class="result-type text-primary">
        {{ $item['tipo'] }}
    </div>
    
    <h3 class="result-title">
        <a href="{{ $item['url'] }}">{{ $item['titulo'] }}</a>
    </h3>
    
    <div class="result-meta">
        @if($item['categoria'])
            <span class="badge bg-secondary me-2">{{ $item['categoria'] }}</span>
        @endif
        @if($item['data'])
            <small><i class="fas fa-calendar me-1"></i>{{ $item['data'] }}</small>
        @endif
    </div>
    
    @if($item['resumo'])
    <p class="result-summary">
        {!! $item['resumo'] !!}
    </p>
    @endif
</div>
@endforeach