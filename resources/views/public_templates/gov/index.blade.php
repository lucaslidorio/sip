@extends('public_templates.gov.layouts.app')

@section('title', 'Página Inicial - ' . $tenant->nome)

@section('content')
<!-- Banner Principal -->
@include('public_templates.gov.includes.hero-carousel')


<!-- Serviços Principais -->
<section class="section-padding">
    <div class="container">
        <div class="section-title">
            <h2>Serviços Online</h2>
            <p>Acesse os principais serviços da prefeitura de forma rápida e prática</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <h3>Nota Fiscal Eletrônica</h3>
                <p>Emita e consulte suas notas fiscais de serviços de forma digital</p>
                <a href="#" class="btn btn-primary">Acessar Serviço</a>
            </div>
            
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-gavel"></i>
                </div>
                <h3>Licitações</h3>
                <p>Acompanhe editais, processos licitatórios e oportunidades de negócio</p>
                <a href="#" class="btn btn-primary">Ver Licitações</a>
            </div>
            
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <h3>Portal da Transparência</h3>
                <p>Consulte gastos públicos, contratos e informações sobre a gestão</p>
                <a href="#" class="btn btn-primary">Acessar Portal</a>
            </div>
            
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <h3>Secretarias</h3>
                <p>Conheça as secretarias municipais e seus serviços</p>
                <a href="#" class="btn btn-primary">Ver Secretarias</a>
            </div>
            
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>Decretos e Portarias</h3>
                <p>Consulte a legislação municipal e atos normativos</p>
                <a href="#" class="btn btn-primary">Consultar Decretos</a>
            </div>
            
            <div class="service-card">
                <div class="service-card-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3>Ouvidoria</h3>
                <p>Registre sugestões, reclamações e elogios</p>
                <a href="#" class="btn btn-primary">Falar Conosco</a>
            </div>
        </div>
    </div>
</section>

<!-- Notícias em Destaque -->
@if($posts_destaque && $posts_destaque->count() > 0)
<section class="news-section">
    <div class="container">
        <div class="section-title">
            <h2>Notícias em Destaque</h2>
            <p>Fique por dentro das principais novidades da nossa cidade</p>
        </div>
        
        <div class="news-grid">
            @foreach($posts_destaque->take(6) as $post)
            <article class="news-card">
                @if($post->imagem)
                <div class="news-card-image" style="background-image: url('{{ asset('storage/' . $post->imagem) }}')">
                    @if($post->categories->first())
                    <span class="news-card-badge">{{ $post->categories->first()->nome }}</span>
                    @endif
                </div>
                @endif
                
                <div class="news-card-content">
                    <div class="news-card-date">
                        <i class="fas fa-calendar me-1"></i>
                        {{ $post->created_at->format('d/m/Y') }}
                    </div>
                    <h3>
                        <a href="{{ route('noticias.show', $post->url) }}">
                            {{ $post->titulo }}
                        </a>
                    </h3>
                    <p class="news-card-excerpt">
                        {{ Str::limit(strip_tags($post->conteudo), 120) }}
                    </p>
                    <a href="{{ route('noticias.show', $post->url) }}" class="btn btn-outline-primary btn-sm">
                        Ler mais <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('noticias.todas') }}" class="btn btn-primary btn-lg">
                Ver todas as notícias <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Acesso Rápido -->
<section class="quick-access">
    <div class="container">
        <h2>Acesso Rápido</h2>
        
        <div class="quick-access-grid">
            <a href="#" class="quick-access-card">
                <div class="quick-access-card-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h4>Localização</h4>
                <p>Endereço e horário de funcionamento</p>
            </a>
            
            <a href="#" class="quick-access-card">
                <div class="quick-access-card-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h4>Telefones Úteis</h4>
                <p>Contatos das secretarias</p>
            </a>
            
            <a href="{{ route('site.agenda') }}" class="quick-access-card">
                <div class="quick-access-card-icon">
                    <i class="fas fa-calendar"></i>
                </div>
                <h4>Agenda Pública</h4>
                <p>Eventos e compromissos</p>
            </a>
            
            <a href="#" class="quick-access-card">
                <div class="quick-access-card-icon">
                    <i class="fas fa-download"></i>
                </div>
                <h4>Downloads</h4>
                <p>Formulários e documentos</p>
            </a>
        </div>
    </div>
</section>

<!-- Links Úteis -->
@if($linksDireita && $linksDireita->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Links Úteis</h2>
            <p>Acesse sites e serviços importantes</p>
        </div>
        
        <div class="row">
            @foreach($linksDireita as $link)
            <div class="col-md-4 col-lg-3 mb-3">
                <a href="{{ $link->url }}" target="_blank" class="card h-100 text-decoration-none">
                    <div class="card-body text-center">
                        @if($link->imagem)
                        <img src="{{ asset('storage/' . $link->imagem) }}" alt="{{ $link->titulo }}" class="img-fluid mb-3" style="max-height: 60px;">
                        @endif
                        <h6 class="card-title">{{ $link->titulo }}</h6>
                        @if($link->descricao)
                        <p class="card-text small text-muted">{{ $link->descricao }}</p>
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Popups -->
@if($popups && $popups->count() > 0)
@foreach($popups as $popup)
<div class="modal fade" id="popup{{ $popup->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $popup->titulo }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($popup->imagem)
                <img src="{{ asset('storage/' . $popup->imagem) }}" alt="{{ $popup->titulo }}" class="img-fluid mb-3">
                @endif
                {!! $popup->conteudo !!}
            </div>
            @if($popup->url)
            <div class="modal-footer">
                <a href="{{ $popup->url }}" class="btn btn-primary" target="_blank">
                    {{ $popup->texto_botao ?? 'Saiba mais' }}
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endforeach
@endif
@endsection

@push('scripts')
<!-- Script para popups -->
@if($popups && $popups->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($popups as $popup)
    @if($popup->exibir_automaticamente)
    setTimeout(function() {
        var modal = new bootstrap.Modal(document.getElementById('popup{{ $popup->id }}'));
        modal.show();
    }, {{ $popup->tempo_exibicao ?? 3000 }});
    @endif
    @endforeach
});
</script>
@endif
@endpush

