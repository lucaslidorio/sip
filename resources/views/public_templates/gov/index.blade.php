@extends('public_templates.gov.layouts.app')

@section('title', 'Página Inicial - ' . $tenant->nome)

@section('content')
<!-- Banner Principal -->
@include('public_templates.gov.includes.hero-carousel')


<!-- Serviços Principais -->

@if($linksServicosOnline && $linksServicosOnline->count() > 0)
<section class="section-padding">
    <div class="container">
        <div class="section-title">
            <h2>Serviços Online</h2>
            <p>Acesse os principais serviços da prefeitura de forma rápida e prática</p>
        </div>
        <div class="services-grid">
            @foreach($linksServicosOnline as $link)
            <div class="service-card">
                <div class="service-card-icon">
                    @if($link->icone)
                    <img src="{{ config('app.aws_url').$link->icone }}" alt="{{ $link->nome }}" class="img-fluid mb-2"
                        style="max-height:60px;">
                    @endif
                </div>
                <h3>{{ $link->nome }}</h3>
                @if($link->descricao)
                <p>{{ $link->descricao }}</p>
                @endif
                <a href="{{ $link->url }}" class="btn btn-primary">Acessar Serviço</a>
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif



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
@if($linksAcessoRapido && $linksAcessoRapido->count() > 0)
<section class="quick-access">
    <div class="container">
        <h2>Acesso Rápido</h2>        
        <div class="quick-access-grid">
            @foreach($linksAcessoRapido as $link)
                <a href="{{ $link->url }}" class="quick-access-card" @if($link->target) target="_blank" @endif>
                    <div class="quick-access-card-icon">
                        @if($link->icone)
                            <img src="{{ config('app.aws_url').$link->icone }}" alt="{{ $link->nome }}" class="img-fluid mb-2" style="max-height:60px;">
                        @endif
                    </div>
                    <h4 >{{ $link->nome }}</h4>
                    @if($link->descricao)
                        <p >{{ $link->descricao }}</p>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- @if($linksAcessoRapido && $linksUteisInferior->count() > 0)
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
@endif --}}

<!-- Links Úteis -->
@if($linksUteisInferior && $linksUteisInferior->count() > 0)
<section class="section-padding bg-light">
    <div class="container">
        <div class="section-title">
            <h2>Links Úteis</h2>
            <p>Acesse sites e serviços importantes</p>
        </div>
        
        <div class="row">
            @foreach($linksUteisInferior as $link)
            <div class="col-md-4 col-lg-3 mb-3">
                <a href="{{ $link->url }}" target="_blank" class="card h-100 text-decoration-none link-util-card">
                    <div class="card-body text-center">
                        @if($link->icone)
                        <img src="{{config('app.aws_url').$link->icone}}" alt="{{ $link->nome }}" class="img-fluid mb-3 link-util-icon" style="max-height: 60px;">
                        @endif
                        <h6 class="card-title">{{ $link->nome }}</h6>
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

