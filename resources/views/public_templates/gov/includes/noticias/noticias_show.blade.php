@extends('public_templates.gov.layouts.app')

@section('title', $noticia->titulo . ' - ' . $tenant->nome)
@section('description', Str::limit(strip_tags($noticia->conteudo), 160))

@section('content')
<div class="container section-padding">
    <div class="row">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('site.index') }}">
                            <i class="fas fa-home"></i> Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('noticias.todas') }}">Notícias</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ Str::limit($noticia->titulo, 50) }}
                    </li>
                </ol>
            </nav>

            <!-- Artigo Principal -->
            <article class="news-article">
                <!-- Cabeçalho -->
                <header class="article-header mb-4">
                    <!-- Categoria e Data -->
                    <div class="article-meta mb-3">
                        @if($noticia->categories->first())
                        <span class="badge bg-primary me-3">
                            {{ $noticia->categories->first()->nome }}
                        </span>
                        @endif
                        <span class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            {{ $noticia->created_at->format('d/m/Y \à\s H:i') }}
                        </span>
                        @if($noticia->updated_at != $noticia->created_at)
                        <span class="text-muted ms-3">
                            <i class="fas fa-edit me-1"></i>
                            Atualizado em {{ $noticia->updated_at->format('d/m/Y \à\s H:i') }}
                        </span>
                        @endif
                    </div>

                    <!-- Título -->
                    <h1 class="article-title text-primary-color">
                        {{ $noticia->titulo }}
                    </h1>

                    <!-- Subtítulo -->
                    @if($noticia->subtitulo)
                    <p class="article-subtitle text-muted">
                        {{ $noticia->subtitulo }}
                    </p>
                    @endif
                </header>

                <!-- Imagem Principal -->
                @if($noticia->imagem)
                <div class="article-image mb-4">
                    <img src="{{ asset('storage/' . $noticia->imagem) }}" 
                         alt="{{ $noticia->titulo }}" 
                         class="img-fluid rounded shadow-sm">
                    @if($noticia->legenda_imagem)
                    <figcaption class="figure-caption text-center mt-2">
                        {{ $noticia->legenda_imagem }}
                    </figcaption>
                    @endif
                </div>
                @endif

                <!-- Conteúdo -->
                <div class="article-content">
                    {!! $noticia->conteudo !!}
                </div>

                <!-- Tags -->
                @if($noticia->tags && $noticia->tags->count() > 0)
                <div class="article-tags mt-4 pt-3 border-top">
                    <h6 class="text-muted mb-2">Tags:</h6>
                    @foreach($noticia->tags as $tag)
                    <a href="{{ route('noticias.todas', ['tag' => $tag->nome]) }}" 
                       class="badge bg-light text-dark text-decoration-none me-2 mb-2">
                        #{{ $tag->nome }}
                    </a>
                    @endforeach
                </div>
                @endif

                <!-- Anexos -->
                @if($noticia->anexos && $noticia->anexos->count() > 0)
                <div class="article-attachments mt-4 pt-3 border-top">
                    <h6 class="text-primary-color mb-3">
                        <i class="fas fa-paperclip me-2"></i>
                        Anexos
                    </h6>
                    
                    <div class="list-group">
                        @foreach($noticia->anexos as $anexo)
                        <a href="{{ asset('storage/' . $anexo->arquivo) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                           target="_blank">
                            <div>
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                {{ $anexo->nome }}
                                @if($anexo->descricao)
                                <small class="text-muted d-block">{{ $anexo->descricao }}</small>
                                @endif
                            </div>
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-download"></i>
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Compartilhamento -->
                <div class="article-share mt-5 pt-4 border-top">
                    <h6 class="text-muted mb-3">Compartilhar esta notícia:</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($noticia->titulo) }}" 
                           target="_blank" 
                           class="btn btn-outline-info btn-sm">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($noticia->titulo . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" 
                           class="btn btn-outline-success btn-sm">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="fab fa-linkedin me-1"></i> LinkedIn
                        </a>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                            <i class="fas fa-link me-1"></i> Copiar Link
                        </button>
                    </div>
                </div>
            </article>

            <!-- Navegação entre notícias -->
            <div class="article-navigation mt-5 pt-4 border-top">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Notícia anterior -->
                        @if($noticia->id > 1)
                        @php
                            $anterior = App\Models\Post::where('id', '<', $noticia->id)->orderBy('id', 'desc')->first();
                        @endphp
                        @if($anterior)
                        <a href="{{ route('noticias.show', $anterior->url) }}" 
                           class="btn btn-outline-primary w-100 text-start">
                            <i class="fas fa-arrow-left me-2"></i>
                            <small class="d-block text-muted">Notícia anterior</small>
                            {{ Str::limit($anterior->titulo, 50) }}
                        </a>
                        @endif
                        @endif
                    </div>
                    <div class="col-md-6">
                        <!-- Próxima notícia -->
                        @php
                            $proxima = App\Models\Post::where('id', '>', $noticia->id)->orderBy('id', 'asc')->first();
                        @endphp
                        @if($proxima)
                        <a href="{{ route('noticias.show', $proxima->url) }}" 
                           class="btn btn-outline-primary w-100 text-end">
                            <i class="fas fa-arrow-right ms-2"></i>
                            <small class="d-block text-muted">Próxima notícia</small>
                            {{ Str::limit($proxima->titulo, 50) }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="article-sidebar">
                <!-- Notícias Relacionadas -->
                @if($ultimasNoticias && $ultimasNoticias->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Notícias Relacionadas</h3>
                    @foreach($ultimasNoticias as $relacionada)
                    <div class="related-news-item mb-3">
                        <div class="row g-2">
                            @if($relacionada->imagem)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $relacionada->imagem) }}" 
                                     alt="{{ $relacionada->titulo }}" 
                                     class="img-fluid rounded">
                            </div>
                            <div class="col-8">
                            @else
                            <div class="col-12">
                            @endif
                                <h6 class="mb-1">
                                    <a href="{{ route('noticias.show', $relacionada->url) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ Str::limit($relacionada->titulo, 60) }}
                                    </a>
                                </h6>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $relacionada->created_at->format('d/m/Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('noticias.todas') }}" class="btn btn-outline-primary btn-sm">
                            Ver todas as notícias
                        </a>
                    </div>
                </div>
                @endif

                <!-- Categorias -->
                @if($categorias && $categorias->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Categorias</h3>
                    <div class="list-group">
                        @foreach($categorias->take(8) as $categoria)
                        <a href="{{ route('noticias.todas', ['category_id' => $categoria->id]) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>{{ $categoria->nome }}</span>
                            <span class="badge bg-primary rounded-pill">
                                {{ $categoria->posts_count }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

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

                <!-- Contato -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Contato</h3>
                    <div class="contact-info">
                        @if($tenant->telefone)
                        <p class="mb-2">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <a href="tel:{{ $tenant->telefone }}">{{ $tenant->telefone }}</a>
                        </p>
                        @endif
                        
                        @if($tenant->email)
                        <p class="mb-2">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a>
                        </p>
                        @endif
                        
                        @if($tenant->endereco)
                        <p class="mb-0">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{ $tenant->endereco }}
                        </p>
                        @endif
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.article-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 1rem;
}

.article-subtitle {
    font-size: 1.25rem;
    line-height: 1.4;
    margin-bottom: 1.5rem;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    color: var(--primary-color);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
    margin: 1rem 0;
}

.article-content blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: var(--primary-lighter);
    padding: 1rem;
    border-radius: var(--border-radius-md);
}

.article-content p {
    margin-bottom: 1.5rem;
}

.related-news-item {
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--gray-200);
}

.related-news-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.related-news-item h6 a:hover {
    color: var(--primary-color) !important;
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

.contact-info a {
    color: var(--text-primary);
    text-decoration: none;
}

.contact-info a:hover {
    color: var(--primary-color);
}

.article-navigation .btn {
    height: auto;
    padding: 1rem;
    white-space: normal;
}

@media (max-width: 768px) {
    .article-title {
        font-size: 2rem;
    }
    
    .article-subtitle {
        font-size: 1.1rem;
    }
    
    .article-content {
        font-size: 1rem;
    }
    
    .article-navigation .col-md-6 {
        margin-bottom: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Mostrar feedback visual
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check me-1"></i> Copiado!';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-secondary');
        }, 2000);
    });
}
</script>
@endpush

