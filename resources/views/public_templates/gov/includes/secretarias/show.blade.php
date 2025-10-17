@extends('public_templates.gov.layouts.app')

@section('title', $secretaria->nome . ' - ' . $tenant->nome)
@section('description', $secretaria->sobre ? Str::limit(strip_tags($secretaria->sobre), 160) : 'Conheça mais sobre a ' . $secretaria->nome)

@section('content')
<div class="container section-padding">
    <div class="row">
        <div class="col-lg-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                      {{ Breadcrumbs::render('secretaria', $secretaria) }}
                </ol>
            </nav>

            <!-- Cabeçalho da Secretaria -->
            <div class="secretaria-header mb-5">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="secretaria-info">
                            <!-- Ícone e Nome -->
                            <div class="d-flex align-items-center mb-3">
                                @if($secretaria->icone)
                                <div class="secretaria-icon me-3" style="--cor-destaque: {{ $secretaria->cor_destaque ?? 'var(--primary-color)' }}">
                                    <i class="{{ $secretaria->icone }}"></i>
                                </div>
                                @endif
                                <div>
                                    <h1 class="secretaria-title mb-1">{{ $secretaria->nome }}</h1>
                                    @if($secretaria->sigla)
                                    <span class="secretaria-sigla">{{ $secretaria->sigla }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Slogan -->
                            @if($secretaria->slogan)
                            <p class="secretaria-slogan text-muted mb-3">
                                <i class="fas fa-quote-left me-2"></i>
                                {{ $secretaria->slogan }}
                            </p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Status -->
                    <div class="col-md-4 text-md-end fs-1" >
                        <i class="{{ $secretaria->icone }}"></i>
                    </div>
                </div>
            </div>

            <!-- Sobre a Secretaria -->
            @if($secretaria->sobre)
            <div class="secretaria-about mb-5">
                <h2 class="section-title">
                    <i class="fas fa-info-circle me-2"></i>
                    Sobre a Secretaria
                </h2>
                <div class="about-content">
                    {!!$secretaria->sobre ?? 'Nenhuma informação disponível.' !!}
                </div>
            </div>
            @endif

            <!-- Responsável pela Secretaria -->
            @if($secretaria->nome_responsavel)
            <div class="secretaria-responsavel mb-5">
                <h2 class="section-title">
                    <i class="fas fa-user-tie me-2"></i>
                    Secretário(a)/Reponsável
                </h2>
                
                <div class="responsavel-card">
                    <div class="row align-items-center">
                        @if($secretaria->img_secretario)
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="responsavel-photo">
                                @if($secretaria->img_secretario)
                                    <img src="{{config('app.aws_url').$secretaria->img_secretario }}" 
                                         alt="{{ $secretaria->nome_responsavel }}" 
                                         class="img-fluid rounded-circle">
                                @else
                                    <img src="{{config('app.aws_url').'uteis/no-image.jpg'}}" 
                                         alt="Sem foto" 
                                         class="img-fluid rounded-circle">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                        @else
                        <div class="col-12">
                        @endif
                            <h3 class="responsavel-nome">{{ $secretaria->nome_responsavel }}</h3>
                            <p class="responsavel-cargo text-muted mb-3">
                                Responsável pela {{ $secretaria->nome }}
                            </p>
                            
                            @if($secretaria->sobre_secretario)
                            <div class="responsavel-bio">
                                {!! nl2br(e($secretaria->sobre_secretario)) !!}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

           

            <!-- Horário de Funcionamento -->
            <div class="secretaria-schedule mb-5">
                <h2 class="section-title">
                    <i class="fas fa-clock me-2"></i>
                    Horário de Funcionamento
                </h2>
                
                <div class="schedule-card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="schedule-item">
                                <strong>{{$tenant->dia_atendimento}}</strong>
                              
                            </div>
                        </div>
                        
                    </div>
                    <div class="schedule-note">
                        <i class="fas fa-info-circle me-2"></i>
                        <small class="text-muted">
                            Horários podem variar em feriados e datas especiais. 
                            Entre em contato para confirmar.
                        </small>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
             <div class="secretaria-actions mb-5">
                <h2 class="section-title">
                    <i class="fas fa-bolt me-2"></i>
                    Ações Rápidas
                </h2>
                
                <div class="actions-grid">
                    @if($secretaria->telefone)
                    <a href="tel:{{ $secretaria->telefone }}" class="action-btn">
                        <i class="fas fa-phone"></i>
                        <span>Ligar</span>
                    </a>
                    @endif
                    
                    @if($secretaria->email)
                    <a href="mailto:{{ $secretaria->email }}" class="action-btn">
                        <i class="fas fa-envelope"></i>
                        <span>E-mail</span>
                    </a>
                    @endif
                    
                    @if($secretaria->endereco)
                    <a href="https://maps.google.com/?q={{ urlencode($secretaria->endereco) }}" 
                       target="_blank" class="action-btn">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Localizar</span>
                    </a>
                    @endif
                    
                    @if($secretaria->celular)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $secretaria->celular) }}" 
                       target="_blank" class="action-btn">
                        <i class="fab fa-whatsapp"></i>
                        <span>WhatsApp</span>
                    </a>
                    @endif
                </div>
            </div>
             <!-- Serviços e Competências -->
            <div class="secretaria-services mb-5">
                <h2 class="section-title">
                    <i class="far fa-newspaper"></i>
                    Noticias Relacionadas
                </h2>
                
                <div class="services-grid">
                    @if($noticiasRelacionadas && $noticiasRelacionadas->count() > 0)
                        @foreach($noticiasRelacionadas as $noticia)
                        <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-rss-square"></i>
                        </div>
                        <div class="service-content">
                            <h4>{{  Str::limit($noticia->titulo, 60)}}</h4>
                            <p>{!!Str::limit(strip_tags($noticia->conteudo), 150)!!}</p>
                        </div>
                        <a href="{{ route('noticias.show', $noticia->url) }}" class="btn btn-outline-primary btn-sm">
                        Ler mais <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                    </div>
                        @endforeach
                    @else
                        <p>Nenhuma notícia relacionada encontrada.</p>  
                    @endif
                    
                    
                
                    
                    
                </div>
            </div>
               
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="secretaria-sidebar">
                <!-- Informações de Contato -->
                <div class="sidebar-widget contact-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-address-card me-2"></i>
                        Informações de Contato
                    </h3>
                    
                    <div class="contact-info">
                        @if($secretaria->telefone)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <strong>Telefone</strong>
                                <a href="tel:{{ $secretaria->telefone }}">{{ $secretaria->telefone }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($secretaria->celular)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="contact-details">
                                <strong>Celular</strong>
                                <a href="tel:{{ $secretaria->celular }}">{{ $secretaria->celular }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($secretaria->email)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <strong>E-mail</strong>
                                <a href="mailto:{{ $secretaria->email }}">{{ $secretaria->email }}</a>
                            </div>
                        </div>
                        @endif
                        
                        @if($secretaria->endereco)
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <strong>Endereço</strong>
                                <span>{{ $secretaria->endereco }}</span>
                                <a href="https://maps.google.com/?q={{ urlencode(implode(', ', array_filter([$secretaria->endereco, $tenant->cidade]))) }}" 
                                   target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    Ver no Mapa
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Outras Secretarias -->
                @if(isset($outrasSecretarias) && $outrasSecretarias->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-building me-2"></i>
                        Outras Secretarias
                    </h3>
                    
                    <div class="secretarias-list">
                        @foreach($outrasSecretarias as $outra)
                        <a href="{{ route('site.secretarias.show', $outra->url) }}" 
                           class="secretaria-link">
                            <div class="secretaria-item">
                                @if($outra->icone)
                                <div class="secretaria-mini-icon">
                                    <i class="{{ $outra->icone }}"></i>
                                </div>
                                @endif
                                <div class="secretaria-mini-info">
                                    <strong>{{ $outra->nome }}</strong>
                                    @if($outra->sigla)
                                    <small class="text-muted">({{ $outra->sigla }})</small>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('site.secretarias.index') }}" class="btn btn-outline-primary btn-sm">
                            Ver todas as secretarias
                        </a>
                    </div>
                </div>
                @endif

                <!-- Acesso Rápido -->
                @include('public_templates.gov.includes.acesso-rapido')

                <!-- Compartilhamento -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-share-alt me-2"></i>
                        Compartilhar
                    </h3>
                    
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-sm me-2 mb-2">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($secretaria->nome) }}" 
                           target="_blank" 
                           class="btn btn-outline-info btn-sm me-2 mb-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($secretaria->nome . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" 
                           class="btn btn-outline-success btn-sm me-2 mb-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm" 
                                data-copy-to-clipboard="{{ request()->fullUrl() }}">
                            <i class="fas fa-link me-1"></i> Copiar Link
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Estilos para a página da secretaria */
.secretaria-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2rem;
    border-radius: var(--border-radius-lg);
    border-left: 4px solid var(--primary-color);
}

.secretaria-icon {
    width: 60px;
    height: 60px;
    background: var(--cor-destaque, var(--primary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.secretaria-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0;
}

.secretaria-sigla {
    background: var(--primary-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.secretaria-slogan {
    font-size: 1.1rem;
    font-style: italic;
    border-left: 3px solid var(--primary-lighter);
    padding-left: 1rem;
    margin-left: 1rem;
}

.secretaria-status {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

/* Seções */
.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.about-content {
    font-size: 1.1rem;
    line-height: 1.8;
    text-align: justify;
}

/* Card do Responsável */
.responsavel-card {
    background: white;
    padding: 2rem;
    border-radius: var(--border-radius-lg);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--gray-200);
}

.responsavel-photo {
    position: relative;
}

.responsavel-photo img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 4px solid var(--primary-lighter);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.responsavel-nome {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.responsavel-cargo {
    font-size: 1rem;
    font-weight: 500;
}

.responsavel-bio {
    font-size: 1rem;
    line-height: 1.6;
    color: #6c757d;
}

/* Grid de Serviços */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.service-item {
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
    transition: all 0.3s ease;
}

.service-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
}

.service-icon {
    width: 50px;
    height: 50px;
    background: var(--primary-lighter);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.2rem;
    margin-bottom: 1rem;
}

.service-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.service-content p {
    font-size: 0.9rem;
    color: #6c757d;
    margin: 0;
}

/* Horário */
.schedule-card {
    background: white;
    padding: 1.5rem;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.schedule-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.schedule-item:last-child {
    border-bottom: none;
}

.schedule-note {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--gray-200);
}

/* Ações Rápidas */
.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1rem;
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1.5rem 1rem;
    background: white;
    border: 2px solid var(--primary-lighter);
    border-radius: var(--border-radius-md);
    text-decoration: none;
    color: var(--primary-color);
    transition: all 0.3s ease;
    font-weight: 500;
}

.action-btn:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.action-btn i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

/* Sidebar */
.sidebar-widget {
    background: white;
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

.contact-widget {
    border-left: 4px solid var(--primary-color);
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.contact-item:last-child {
    margin-bottom: 0;
}

.contact-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-lighter);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    margin-right: 1rem;
    flex-shrink: 0;
}

.contact-details strong {
    display: block;
    color: var(--primary-color);
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
}

.contact-details a {
    color: #6c757d;
    text-decoration: none;
}

.contact-details a:hover {
    color: var(--primary-color);
}

/* Lista de Secretarias */
.secretaria-link {
    text-decoration: none;
    color: inherit;
}

.secretaria-item {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    border-radius: var(--border-radius-md);
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.secretaria-item:hover {
    background: var(--primary-lighter);
    border-color: var(--primary-color);
}

.secretaria-mini-icon {
    width: 35px;
    height: 35px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.secretaria-mini-info strong {
    font-size: 0.9rem;
    display: block;
    line-height: 1.2;
}

/* Responsividade */
@media (max-width: 768px) {
    .secretaria-title {
        font-size: 2rem;
    }
    
    .secretaria-header {
        padding: 1.5rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .responsavel-photo img {
        width: 100px;
        height: 100px;
    }
}

@media (max-width: 576px) {
    .secretaria-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .action-btn {
        padding: 1rem;
    }
}
</style>
@endpush

@push('scripts')
<script>

</script>
@endpush

