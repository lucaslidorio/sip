{{-- resources/views/public_templates/gov/pesquisa/resultados.blade.php --}}

@extends('public_templates.gov.layouts.app')

@section('title', 'Resultados da Pesquisa - ' . $tenant->nome)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site.index') }}">Início</a></li>
                    <li class="breadcrumb-item active">Pesquisa</li>
                </ol>
            </nav>

            <div class="search-header mb-4">
                <h1>Resultados da Pesquisa</h1>
                <p class="lead">
                    Encontrados <strong>{{ $total }}</strong> resultados para: 
                    <strong>"{{ $termo }}"</strong>
                </p>
                
                <!-- Formulário de pesquisa novamente -->
                <form method="GET" action="{{ route('site.pesquisar') }}" class="mb-4">
                    <div class="input-group">
                        <input type="text" 
                               name="pesquisar" 
                               class="form-control" 
                               placeholder="Digite sua pesquisa..." 
                               value="{{ $termo }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Pesquisar
                        </button>
                    </div>
                </form>
            </div>

            @if($total > 0)
                <!-- Filtros por categoria -->
                <div class="filter-tabs mb-4">
                    <ul class="nav nav-pills" id="categoryTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#todos">
                                Todos ({{ $total }})
                            </a>
                        </li>
                        @if($resultados['noticias']->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#noticias">
                                Notícias ({{ $resultados['noticias']->count() }})
                            </a>
                        </li>
                        @endif
                        @if($resultados['secretarias']->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#secretarias">
                                Secretarias ({{ $resultados['secretarias']->count() }})
                            </a>
                        </li>
                        @endif
                        @if($resultados['paginas']->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#paginas">
                                Páginas ({{ $resultados['paginas']->count() }})
                            </a>
                        </li>
                        @endif
                        @if($resultados['leis']->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="pill" href="#leis">
                                Legislação ({{ $resultados['leis']->count() }})
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>

                <!-- Conteúdo das abas -->
                <div class="tab-content">
                    <!-- Aba Todos -->
                    <div class="tab-pane fade show active" id="todos">
                        @foreach($resultados as $categoria => $items)
                            @if($items->count() > 0)
                                @include('public_templates.gov.includes.pesquisar.categoria', ['items' => $items, 'categoria' => $categoria])
                            
                                @endif
                        @endforeach
                    </div>

                    <!-- Abas específicas -->
                    @foreach($resultados as $categoria => $items)
                        @if($items->count() > 0)
                        <div class="tab-pane fade" id="{{ $categoria }}">
                            @include('public_templates.gov.includes.pesquisar.categoria', ['items' => $items, 'categoria' => $categoria])
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="no-results text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h3>Nenhum resultado encontrado</h3>
                    <p class="text-muted">
                        Não encontramos nenhum resultado para "<strong>{{ $termo }}</strong>".
                    </p>
                    <div class="suggestions mt-4">
                        <h5>Sugestões:</h5>
                        <ul class="list-unstyled">
                            <li>• Verifique a ortografia das palavras</li>
                            <li>• Tente usar termos mais gerais</li>
                            <li>• Use palavras-chave diferentes</li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.search-result-item {
    border-bottom: 1px solid #eee;
    padding: 1.5rem 0;
}

.search-result-item:last-child {
    border-bottom: none;
}

.result-type {
    font-size: 0.8rem;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.result-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.result-title a {
    color: #007bff;
    text-decoration: none;
}

.result-title a:hover {
    text-decoration: underline;
}

.result-meta {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.result-summary {
    color: #495057;
    line-height: 1.5;
}

.highlight {
    background-color: #fff3cd;
    padding: 0 2px;
    font-weight: 600;
}
</style>
@endpush