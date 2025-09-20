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
                    {{ Breadcrumbs::render('noticia', $noticia) }}
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

                <!-- Imagem de Destaque - Posicionada no início do conteúdo -->
                @if($noticia->img_destaque)
                <div class="article-featured-image mb-5">
                    <figure class="featured-image-container">
                        <img src="{{config('app.aws_url').$noticia->img_destaque}}" 
                             alt="{{ $noticia->titulo }}" 
                             class="img-fluid featured-image">
                        @if($noticia->img_destaque)
                        <figcaption class="featured-image-caption">
                            {{-- {{ $noticia->img_destaque }} --}}
                        </figcaption>
                        @endif
                    </figure>
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

               
                <!-- Galeria de Imagens - Posicionada no final do conteúdo -->
                @if(isset($noticia->imagens) && count($noticia->imagens) > 0)
                <div class="article-gallery mt-5 pt-4 border-top">
                    <h3 class="gallery-title text-primary-color mb-4">
                        <i class="fas fa-images me-2"></i>
                        Galeria de Imagens
                    </h3>
                    
                   
                    <div class="gallery-grid">
             
                        @foreach($noticia->imagens as $index => $imagem)
                        <div class="gallery-item" data-index="{{ $index }}">
                            <img src="{{config('app.aws_url').$imagem->img}}" 
                                 alt="Imagem {{ $index + 1 }} - {{ $noticia->titulo }}" 
                                 class="gallery-thumbnail"
                                 loading="lazy">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Lightbox para Galeria -->
                <div class="gallery-lightbox" id="galleryLightbox">
                    <div class="lightbox-backdrop"></div>
                    <div class="lightbox-container">
                        <button class="lightbox-close" id="closeLightbox">
                            <i class="fas fa-times"></i>
                        </button>
                        
                        <button class="lightbox-nav lightbox-prev" id="prevImage">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <div class="lightbox-content">
                            <img id="lightboxImage" src="" alt="">
                            <div class="lightbox-caption" id="lightboxCaption"></div>
                        </div>
                        
                        <button class="lightbox-nav lightbox-next" id="nextImage">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        
                        <div class="lightbox-counter" id="lightboxCounter"></div>
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
                                data-copy-to-clipboard="{{ request()->fullUrl() }}">
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
                    <h3 class="sidebar-widget-title">Últimas Notícias</h3>
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
                @include('public_templates.gov.includes.acesso-rapido')

                <!-- Contato -->
                @include('public_templates.gov.includes.contato-lateral')
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Estilos para a imagem de destaque */
.article-featured-image {
    margin-bottom: 2rem;
}

.featured-image-container {
    position: relative;
    border-radius: var(--border-radius-lg);
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    margin: 0;
}

.featured-image {
    width: 100%;
    height: auto;
    max-height: 500px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.featured-image-container:hover .featured-image {
    transform: scale(1.02);
}

.featured-image-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
    padding: 2rem 1.5rem 1rem;
    font-size: 0.9rem;
    line-height: 1.4;
    margin: 0;
}

/* Estilos para a galeria */
.article-gallery {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: var(--border-radius-lg);
    margin-top: 3rem;
}

.gallery-title {
    font-size: 1.5rem;
    font-weight: 600;
    text-align: center;
    margin-bottom: 2rem;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.gallery-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: var(--border-radius-md);
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.gallery-thumbnail {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover .gallery-thumbnail {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-overlay i {
    color: white;
    font-size: 2rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Lightbox */
.gallery-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: center;
}

.gallery-lightbox.active {
    display: flex;
}

.lightbox-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    backdrop-filter: blur(5px);
}

.lightbox-container {
    position: relative;
    max-width: 90%;
    max-height: 90%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-content {
    position: relative;
    text-align: center;
}

.lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    border-radius: var(--border-radius-md);
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

.lightbox-caption {
    color: white;
    margin-top: 1rem;
    font-size: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.lightbox-close {
    position: absolute;
    top: -50px;
    right: 0;
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 1.5rem;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-close:hover {
    background: rgba(255,255,255,0.3);
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    font-size: 1.5rem;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-nav:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-50%) scale(1.1);
}

.lightbox-prev {
    left: -70px;
}

.lightbox-next {
    right: -70px;
}

.lightbox-counter {
    position: absolute;
    bottom: -40px;
    left: 50%;
    transform: translateX(-50%);
    color: white;
    font-size: 0.9rem;
    background: rgba(0,0,0,0.5);
    padding: 0.5rem 1rem;
    border-radius: 20px;
}

/* Estilos gerais do artigo */
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

/* Sidebar */
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

/* Responsividade */
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
    
    .featured-image {
        max-height: 300px;
    }
    
    .featured-image-caption {
        padding: 1.5rem 1rem 0.75rem;
        font-size: 0.8rem;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .lightbox-nav {
        display: none;
    }
    
    .lightbox-close {
        top: -40px;
        font-size: 1.2rem;
        width: 35px;
        height: 35px;
    }
    
    .article-gallery {
        padding: 1.5rem;
    }
}

@media (max-width: 576px) {
    .gallery-grid {
        grid-template-columns: 1fr;
    }
    
    .lightbox-content img {
        max-height: 70vh;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Funcionalidade da galeria
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const closeLightbox = document.getElementById('closeLightbox');
    const prevImage = document.getElementById('prevImage');
    const nextImage = document.getElementById('nextImage');
    
    let currentImageIndex = 0;
    const images = Array.from(galleryItems).map(item => {
        const img = item.querySelector('img');
        return {
            src: img.src,
            alt: img.alt
        };
    });
    
    // Abrir lightbox
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            currentImageIndex = index;
            showLightbox();
        });
    });
    
    // Fechar lightbox
    if (closeLightbox) {
        closeLightbox.addEventListener('click', hideLightbox);
    }
    
    // Fechar ao clicar no backdrop
    if (lightbox) {
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox || e.target.classList.contains('lightbox-backdrop')) {
                hideLightbox();
            }
        });
    }
    
    // Navegação
    if (prevImage) {
        prevImage.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            updateLightboxImage();
        });
    }
    
    if (nextImage) {
        nextImage.addEventListener('click', () => {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            updateLightboxImage();
        });
    }
    
    // Navegação por teclado
    document.addEventListener('keydown', (e) => {
        if (!lightbox || !lightbox.classList.contains('active')) return;
        
        switch(e.key) {
            case 'Escape':
                hideLightbox();
                break;
            case 'ArrowLeft':
                if (prevImage) prevImage.click();
                break;
            case 'ArrowRight':
                if (nextImage) nextImage.click();
                break;
        }
    });
    
    function showLightbox() {
        if (lightbox) {
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
            updateLightboxImage();
        }
    }
    
    function hideLightbox() {
        if (lightbox) {
            lightbox.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }
    
    function updateLightboxImage() {
        if (lightboxImage && images[currentImageIndex]) {
            lightboxImage.src = images[currentImageIndex].src;
            lightboxImage.alt = images[currentImageIndex].alt;
            
            if (lightboxCaption) {
                lightboxCaption.textContent = images[currentImageIndex].alt;
            }
            
            if (lightboxCounter) {
                lightboxCounter.textContent = `${currentImageIndex + 1} de ${images.length}`;
            }
        }
    }

    // Lazy loading para imagens da galeria
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

    // Smooth scroll para links internos
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                const headerHeight = document.querySelector('.main-header')?.offsetHeight || 0;
                const targetPosition = target.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
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

    // Animação de entrada para elementos da página
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const fadeInObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Aplicar animação aos elementos da galeria
    const galleryElements = document.querySelectorAll('.gallery-item');
    galleryElements.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        fadeInObserver.observe(item);
    });

    // Função para mostrar notificações
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
});


</script>
@endpush

