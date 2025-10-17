@extends('public_templates.gov.layouts.app')

@section('title', 'Notícias - ' . $tenant->nome)
@section('description', 'Acompanhe as últimas notícias e informações de ' . $tenant->nome)

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            {{ Breadcrumbs::render('noticias') }}
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
                    <div class="card h-100 shadow-sm news-card">
                        <div class="row g-0 h-100">
                            <!-- Thumbnail da Imagem -->
                            <div class="col-md-4 col-lg-3">
                                <div class="news-thumbnail">
                                    @if($noticia->img_destaque)
                                        <img src="{{config('app.aws_url').$noticia->img_destaque}}" 
                                             alt="{{ $noticia->titulo }}" 
                                             class="img-fluid news-image"
                                             loading="lazy">
                                    @else
                                        <div class="news-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay com categoria -->
                                    @if($noticia->categories->first())
                                    <div class="news-category-overlay">
                                        <span class="badge bg-primary">
                                            {{ $noticia->categories->first()->nome }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Conteúdo -->
                            <div class="col-md-8 col-lg-9">
                                <div class="card-body h-100 d-flex flex-column p-3 p-md-4">
                                    <!-- Meta informações -->
                                    <div class="news-meta mb-2">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="fas fa-calendar me-1"></i>
                                            {{ $noticia->created_at->format('d/m/Y') }}
                                            
                                            @if($noticia->created_at->format('H:i') !== '00:00')
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $noticia->created_at->format('H:i') }}
                                            @endif
                                            
                                            @if($noticia->views_count ?? false)
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-eye me-1"></i>
                                            {{ number_format($noticia->views_count) }} visualizações
                                            @endif
                                        </small>
                                    </div>
                                    
                                    <!-- Título -->
                                    <h3 class="news-title h5 mb-3">
                                        <a href="{{ route('noticias.show', $noticia->url) }}" 
                                           class="text-decoration-none text-dark news-link">
                                            {{ $noticia->titulo }}
                                        </a>
                                    </h3>
                                    
                                    <!-- Resumo -->
                                    <p class="news-excerpt text-muted flex-grow-1 mb-3">
                                        {{ Str::limit(strip_tags($noticia->conteudo), 180) }}
                                    </p>
                                    
                                    <!-- Tags (se existirem) -->
                                    @if($noticia->tags && $noticia->tags->count() > 0)
                                    <div class="news-tags mb-3">
                                        @foreach($noticia->tags->take(3) as $tag)
                                        <span class="badge bg-light text-dark me-1">
                                            #{{ $tag->nome }}
                                        </span>
                                        @endforeach
                                    </div>
                                    @endif
                                    
                                    <!-- Ações -->
                                    <div class="news-actions mt-auto d-flex justify-content-between align-items-center">
                                        <a href="{{ route('noticias.show', $noticia->url) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            Ler mais <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                        
                                        <!-- Botões de compartilhamento rápido -->
                                        <div class="share-buttons d-none d-md-flex">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('noticias.show', $noticia->url)) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-secondary me-1 share-btn"
                                               title="Compartilhar no Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a href="https://wa.me/?text={{ urlencode($noticia->titulo . ' - ' . route('noticias.show', $noticia->url)) }}" 
                                               target="_blank" 
                                               class="btn btn-sm btn-outline-secondary share-btn me-1"
                                               title="Compartilhar no WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            {{-- Instagram (via Web Share API / copiar link) --}}
                                         <a href="#" class="btn btn-sm btn-outline-secondary me-1 share-btn instagram-share" title="Compartilhar no Instagram"
                                                onclick="shareNative(event, '{{ route('noticias.show', $noticia->url) }}', 'Instagram')">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                            
                                            {{-- TikTok (via Web Share API / copiar link) --}}
                                            <a href="#" class="btn btn-sm btn-outline-secondary me-1 share-btn tiktok-share" title="Compartilhar no TikTok"
                                                onclick="shareNative(event, '{{ route('noticias.show', $noticia->url) }}', 'TikTok')">
                                                <i class="fab fa-tiktok"></i>
                                            </a>
                                                                                    
                                        </div>
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

                {{-- Acesso Rápido --}}
                @include('public_templates.gov.includes.acesso-rapido')
                
                <!-- Newsletter -->
                {{-- @include('public_templates.gov.includes.newsletter') --}}
                <!-- Contato -->
                @include('public_templates.gov.includes.contato-lateral')
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Estilos para thumbnails das notícias */
.news-thumbnail {
    position: relative;
    height: 200px;
    overflow: hidden;
    border-radius: var(--border-radius-md) 0 0 var(--border-radius-md);
}

.news-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.news-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-lighter) 0%, var(--primary-light) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 2rem;
}

.news-category-overlay {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
    z-index: 2;
}

.news-category-overlay .badge {
    font-size: 0.7rem;
    padding: 0.4rem 0.6rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Hover effects */
.news-card {
    transition: all 0.3s ease;
    border: 1px solid var(--gray-200);
    overflow: hidden;
}

.news-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.news-card:hover .news-image {
    transform: scale(1.05);
}

.news-link {
    transition: color 0.3s ease;
}

.news-link:hover {
    color: var(--primary-color) !important;
}

/* Meta informações */
.news-meta {
    font-size: 0.85rem;
}

.news-meta i {
    color: var(--primary-color);
}

/* Tags */
.news-tags .badge {
    font-size: 0.7rem;
    font-weight: 400;
    border: 1px solid var(--gray-300);
}

/* Botões de compartilhamento */
.share-buttons .btn {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.share-buttons .btn:hover {
    transform: translateY(-2px);
}

/* Filtros */
.filters-section .card {
    border: 1px solid var(--gray-200);
    box-shadow: var(--shadow-sm);
}

/* Sidebar */
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

/* Header da página */
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

/* Responsividade */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .news-thumbnail {
        height: 150px;
        border-radius: var(--border-radius-md) var(--border-radius-md) 0 0;
    }
    
    .news-category-overlay {
        top: 0.5rem;
        left: 0.5rem;
    }
    
    .share-buttons {
        display: none !important;
    }
    
    .news-actions {
        justify-content: center !important;
    }
}

@media (max-width: 576px) {
    .news-thumbnail {
        height: 120px;
    }
    
    .card-body {
        padding: 1rem !important;
    }
    
    .news-title {
        font-size: 1.1rem !important;
    }
    
    .news-excerpt {
        font-size: 0.9rem;
    }
}

/* Animações */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.news-item {
    animation: fadeInUp 0.6s ease forwards;
}

.news-item:nth-child(1) { animation-delay: 0.1s; }
.news-item:nth-child(2) { animation-delay: 0.2s; }
.news-item:nth-child(3) { animation-delay: 0.3s; }
.news-item:nth-child(4) { animation-delay: 0.4s; }
.news-item:nth-child(5) { animation-delay: 0.5s; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading para imagens
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        const lazyImages = document.querySelectorAll('img[data-src]');
        lazyImages.forEach(img => imageObserver.observe(img));
    }

    // Smooth scroll para paginação
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            setTimeout(() => {
                const newsList = document.querySelector('.news-list');
                if (newsList) {
                    newsList.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }, 100);
        });
    });

    // Feedback visual nos botões de compartilhamento
    const shareButtons = document.querySelectorAll('.share-btn');
    shareButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });

    // Animação de entrada dos cards
    const newsItems = document.querySelectorAll('.news-item');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const newsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    newsItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        newsObserver.observe(item);
    });

    // Melhorar acessibilidade - navegação por teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('keyboard-navigation');
        }
    });

    document.addEventListener('mousedown', function() {
        document.body.classList.remove('keyboard-navigation');
    });

    // Adicionar estilos para navegação por teclado se não existirem
    if (!document.querySelector('#keyboard-navigation-styles')) {
        const style = document.createElement('style');
        style.id = 'keyboard-navigation-styles';
        style.textContent = `
            .keyboard-navigation *:focus {
                outline: 2px solid var(--primary-color) !important;
                outline-offset: 2px !important;
            }
            
            .keyboard-navigation *:focus:not(:focus-visible) {
                outline: none !important;
            }
        `;
        document.head.appendChild(style);
    }

    // Função para mostrar notificações (caso necessário)
    window.showNotification = function(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(notification);
        
        if (duration > 0) {
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, duration);
        }
    };

    // Otimização de performance - debounce para scroll
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Scroll suave para links internos
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush

