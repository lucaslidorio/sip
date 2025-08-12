@extends('public_templates.gov.layouts.app')

@section('title', 'Notícias - ' . $tenant->nome)
@section('description', 'Acompanhe as últimas notícias e informações de ' . $tenant->nome)

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.index') }}">
                    <i class="fas fa-home"></i> Início
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Notícias
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-newspaper me-3"></i>
            Notícias
        </h1>
        <p class="page-subtitle text-muted">
            Fique por dentro das principais novidades e acontecimentos da nossa cidade
        </p>
    </div>

    <div class="row">
        <!-- Conteúdo Principal -->
        <div class="col-lg-8">
            <!-- Filtros -->
            <div class="filters-section mb-4">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('noticias.todas') }}">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="pesquisar" class="form-label">Buscar notícias</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="pesquisar" 
                                           name="pesquisar" 
                                           placeholder="Digite sua busca..."
                                           value="{{ request('pesquisar') }}">
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="category_id" class="form-label">Categoria</label>
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="">Todas as categorias</option>
                                        @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" 
                                                {{ request('category_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }} ({{ $categoria->posts_count }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="data_publicacao_inicial" class="form-label">Data inicial</label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="data_publicacao_inicial" 
                                           name="data_publicacao_inicial"
                                           value="{{ request('data_publicacao_inicial') }}">
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="data_publicacao_final" class="form-label">Data final</label>
                                    <input type="date" 
                                           class="form-control" 
                                           id="data_publicacao_final" 
                                           name="data_publicacao_final"
                                           value="{{ request('data_publicacao_final') }}">
                                </div>
                                
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            @if($noticias->count() > 0)
            <div class="results-info mb-3">
                <p class="text-muted">
                    Mostrando {{ $noticias->firstItem() }} a {{ $noticias->lastItem() }} 
                    de {{ $noticias->total() }} notícias
                </p>
            </div>

            <!-- Lista de Notícias -->
            <div class="news-list">
                @foreach($noticias as $noticia)
                <article class="news-item mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="row g-0">
                            @if($noticia->imagem)
                            <div class="col-md-4">
                                <div class="news-image" 
                                     style="background-image: url('{{ asset('storage/' . $noticia->imagem) }}'); 
                                            height: 200px; 
                                            background-size: cover; 
                                            background-position: center;">
                                </div>
                            </div>
                            <div class="col-md-8">
                            @else
                            <div class="col-12">
                            @endif
                                <div class="card-body h-100 d-flex flex-column">
                                    <!-- Categoria e Data -->
                                    <div class="news-meta mb-2">
                                        @if($noticia->categories->first())
                                        <span class="badge bg-primary me-2">
                                            {{ $noticia->categories->first()->nome }}
                                        </span>
                                        @endif
                                        <small class="text-muted">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $noticia->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    
                                    <!-- Título -->
                                    <h3 class="news-title h5 mb-3">
                                        <a href="{{ route('noticias.show', $noticia->url) }}" 
                                           class="text-decoration-none text-dark">
                                            {{ $noticia->titulo }}
                                        </a>
                                    </h3>
                                    
                                    <!-- Resumo -->
                                    <p class="news-excerpt text-muted flex-grow-1">
                                        {{ Str::limit(strip_tags($noticia->conteudo), 150) }}
                                    </p>
                                    
                                    <!-- Ações -->
                                    <div class="news-actions mt-auto">
                                        <a href="{{ route('noticias.show', $noticia->url) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            Ler mais <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $noticias->links() }}
            </div>
            @else
            <!-- Nenhum resultado -->
            <div class="no-results text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-search fa-3x text-muted"></i>
                </div>
                <h3 class="h4 text-muted">Nenhuma notícia encontrada</h3>
                <p class="text-muted">
                    Tente ajustar os filtros ou fazer uma nova busca.
                </p>
                <a href="{{ route('noticias.todas') }}" class="btn btn-primary">
                    Ver todas as notícias
                </a>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="news-sidebar">
                <!-- Categorias -->
                @if($categorias->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Categorias</h3>
                    <div class="list-group">
                        <a href="{{ route('noticias.todas') }}" 
                           class="list-group-item list-group-item-action {{ !request('category_id') ? 'active' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Todas as categorias</span>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $categorias->sum('posts_count') }}
                                </span>
                            </div>
                        </a>
                        @foreach($categorias as $categoria)
                        <a href="{{ route('noticias.todas', ['category_id' => $categoria->id]) }}" 
                           class="list-group-item list-group-item-action {{ request('category_id') == $categoria->id ? 'active' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $categoria->nome }}</span>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $categoria->posts_count }}
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Busca Rápida -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Busca Rápida</h3>
                    <form method="GET" action="{{ route('noticias.todas') }}">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   name="pesquisar" 
                                   placeholder="Buscar notícias..."
                                   value="{{ request('pesquisar') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Acesso Rápido -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Acesso Rápido</h3>
                    <div class="d-grid gap-2">
                        <a href="{{ route('site.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i> Página Inicial
                        </a>
                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-primary">
                            <i class="fas fa-calendar me-2"></i> Agenda
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-gavel me-2"></i> Licitações
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-balance-scale me-2"></i> Transparência
                        </a>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Newsletter</h3>
                    <p class="small text-muted mb-3">
                        Receba as principais notícias diretamente no seu e-mail.
                    </p>
                    <form>
                        <div class="mb-3">
                            <input type="email" 
                                   class="form-control" 
                                   placeholder="Seu e-mail"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-envelope me-2"></i>
                            Inscrever-se
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.news-image {
    border-radius: var(--border-radius-md) 0 0 var(--border-radius-md);
}

.news-title a:hover {
    color: var(--primary-color) !important;
}

.news-item .card {
    transition: var(--transition-normal);
    border: 1px solid var(--gray-200);
}

.news-item .card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg) !important;
}

.filters-section .card {
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

.sidebar-widget {
    background: var(--bg-primary);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.sidebar-widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.page-header {
    padding: 2rem 0;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .news-image {
        height: 150px !important;
        border-radius: var(--border-radius-md) var(--border-radius-md) 0 0;
    }
}
</style>
@endpush

