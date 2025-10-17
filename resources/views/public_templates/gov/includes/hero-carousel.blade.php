<section class="hero-carousel">
    <div class="carousel-container">
        <div class="carousel-wrapper" id="hero-carousel">
            @if($posts_destaque && $posts_destaque->count() > 0)
            
                @foreach($posts_destaque as $index => $noticia)
                    <div class="carousel-slide {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}">
                        <div class="slide-background">
                            <div class="slide-bg-gradient"></div>
                            {{-- @if($noticia->img_destaque)                             
                                <img src="{{config('app.aws_url').$noticia->img_destaque}}" 
                                     alt="{{ $noticia->titulo }}" 
                                     class="slide-bg-image">
                            @else
                                <div class="slide-bg-gradient"></div>
                            @endif --}}
                            <div class="slide-overlay"></div>
                        </div>
                        
                        <div class="container">
                            <div class="row align-items-center min-vh-50">
                                <div class="col-lg-8">
                                    <div class="slide-content">
                                        <div class="slide-meta">
                                            <span class="slide-category">
                                                <i class="fas fa-newspaper me-2"></i>
                                                Notícia em Destaque
                                            </span>
                                            <span class="slide-date">
                                                <i class="fas fa-calendar me-2"></i>
                                                {{ $noticia->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        
                                        <h1 class="slide-title">{{ $noticia->titulo }}</h1>
                                        
                                        @if($noticia->resumo)
                                            <p class="slide-description">{{ Str::limit($noticia->resumo, 150) }}</p>
                                        @endif
                                        
                                        <div class="slide-actions">
                                            <a href="{{ route('noticias.show', $noticia->url) }}" 
                                               class="btn btn-primary btn-lg slide-btn-primary">
                                                <i class="fas fa-arrow-right me-2"></i>
                                                Ler Notícia Completa
                                            </a>
                                            <a href="{{ route('noticias.todas') }}" 
                                               class="btn btn-outline-light btn-lg slide-btn-secondary">
                                                <i class="fas fa-list me-2"></i>
                                                Todas as Notícias
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="slide-image-container">
                                        @if($noticia->imagem_destaque)
                                            <div class="slide-featured-image">
                                                <img src="{{ config('app.aws_url') . $noticia->imagem_destaque }}" 
                                                     alt="{{ $noticia->titulo }}" 
                                                     class="img-fluid rounded shadow-lg">
                                                <div class="image-overlay">
                                                    <i class="fas fa-search-plus"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="slide-placeholder">
                                                <div class="placeholder-content">
                                                    <i class="fas fa-newspaper fa-3x mb-3"></i>
                                                    <h4>{{ $tenant->nome }}</h4>
                                                    <p>{{$tenant->slogan}}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                {{-- Slide padrão quando não há notícias --}}
                <div class="carousel-slide active" data-slide="0">
                    <div class="slide-background">
                        <div class="slide-bg-gradient"></div>
                        <div class="slide-overlay"></div>
                    </div>
                    
                    <div class="container">
                        <div class="row align-items-center min-vh-50">
                            <div class="col-lg-8">
                                <div class="slide-content">
                                    <div class="slide-meta">
                                        <span class="slide-category">
                                            <i class="fas fa-home me-2"></i>
                                            Portal Oficial
                                        </span>
                                    </div>
                                    
                                    <h1 class="slide-title">{{ $tenant->nome }}</h1>
                                    <p class="slide-description">Transparência, eficiência e compromisso com o cidadão</p>
                                    
                                    <div class="slide-actions">
                                        <a href="{{ route('noticias.todas') }}" class="btn btn-primary btn-lg slide-btn-primary">
                                            <i class="fas fa-newspaper me-2"></i>
                                            Últimas Notícias
                                        </a>
                                        <a href="{{ route('site.agenda') }}" class="btn btn-outline-light btn-lg slide-btn-secondary">
                                            <i class="fas fa-calendar me-2"></i>
                                            Agenda do Prefeito
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 text-center">
                                @if($tenant->brasao)
                                    <div class="slide-logo">
                                        <img src="{{ config('app.aws_url') . $tenant->brasao }}" 
                                             alt="Logo {{ $tenant->nome }}" 
                                             class="img-fluid" 
                                             style="max-height: 200px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        {{-- Controles do Carousel --}}
        @if($posts_destaque && $posts_destaque->count() > 1)
            <div class="carousel-controls">
                <button class="carousel-btn carousel-prev" id="carousel-prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="carousel-btn carousel-next" id="carousel-next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            {{-- Indicadores --}}
            <div class="carousel-indicators">
                @foreach($posts_destaque as $index => $noticia)
                    <button class="carousel-indicator {{ $index === 0 ? 'active' : '' }}" 
                            data-slide="{{ $index }}"
                            aria-label="Ir para slide {{ $index + 1 }}">
                        <span class="indicator-progress"></span>
                    </button>
                @endforeach
            </div>
        @endif
    </div>
    
    {{-- Informações adicionais --}}
    <div class="hero-info-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="fas fa-clock text-primary"></i>
                        <span>Atualizado em: {{ $ultimaAtualizacao->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="fas fa-newspaper text-primary"></i>
                        <span>{{ $totalNoticias ?? 0 }} notícias publicadas</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-item">
                        <i class="fas fa-users text-primary"></i>
                        <span>{{ $tenant->nome }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

