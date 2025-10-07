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
    <div class="modal fade" id="popup{{ $popup->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 bg-transparent">
                <!-- Removido o header do modal para não mostrar o título -->
                
                <!-- Botão de fechar flutuante -->
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="modal-body p-0">
                    @if($popup->img)
                    <img src="{{ config('app.aws_url')."{$popup->img}" }}" alt="{{ $popup->nome }}" class="img-fluid">
                    @endif
                </div>
                
                <div class="modal-footer bg-transparent border-0 justify-content-between">
                    <!-- Botão "Não mostrar novamente" -->
                    <button type="button" class="btn btn-sm btn-light" onclick="doNotShowAgain({{ $popup->id }})">
                        <i class="fas fa-eye-slash me-1"></i> Não mostrar novamente
                    </button>
                    
                    @if($popup->url)
                    <a href="{{ $popup->url }}" class="btn btn-primary" target="_blank">
                        {{ $popup->texto_botao ?? 'Saiba mais' }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

<!-- Barra de Aviso de Cookies LGPD -->
<div class="cookie-consent-banner" id="cookieConsentBanner">
    <div class="container">
        <div class="cookie-content">
            <div class="cookie-text">
                <i class="fas fa-cookie-bite cookie-icon"></i>
                <p>Este site utiliza cookies para melhorar sua experiência. Ao continuar navegando, você concorda com nossa <a href="{{ route('site.politica.privacidade') ?? '#' }}" target="_blank">Política de Privacidade</a>.</p>
            </div>
            <div class="cookie-buttons">
                <button class="btn btn-outline-light" onclick="rejectCookies()">Recusar</button>
                <button class="btn btn-light" onclick="acceptCookies()">Aceitar Cookies</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Script para popups -->
@if($popups && $popups->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM carregado, iniciando script de popups');
    
    // Função para verificar se o Bootstrap está carregado
    function bootstrapIsLoaded() {
        const isLoaded = (typeof bootstrap !== 'undefined');
        console.log('Bootstrap carregado?', isLoaded);
        return isLoaded;
    }
    
    // Função para verificar se um popup deve ser mostrado ou foi recusado
    function shouldShowPopup(popupId) {
        const cookieName = `popup_dismissed_${popupId}`;
        return !getCookie(cookieName);
    }
    
    // Função para obter valor de cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }
    
    // Função para mostrar os popups
    function showPopups() {
        console.log('Função showPopups iniciada');
        
        @foreach($popups as $popup)
            console.log('Popup encontrado: ID {{ $popup->id }}, Nome: {{ $popup->nome }}');
            console.log('Ativo?', {{ $popup->ativo ? 'true' : 'false' }});
            
            // Verificar se o popup está ativo e não foi recusado
            @if($popup->ativo)
                if (shouldShowPopup({{ $popup->id }})) {
                    (function(popupId, delay) {
                        console.log(`Configurando timeout para popup ${popupId} com delay de ${delay}ms`);
                        
                        setTimeout(function() {
                            console.log(`Executando exibição do popup ${popupId}`);
                            var modalElement = document.getElementById('popup' + popupId);
                            console.log('Elemento encontrado:', modalElement);
                            
                            if (modalElement) {
                                try {
                                    console.log('Criando instância do modal');
                                    var modalInstance = new bootstrap.Modal(modalElement);
                                    console.log('Instância criada com sucesso');
                                    console.log('Chamando método show()');
                                    modalInstance.show();
                                    console.log('Método show() executado');
                                } catch(err) {
                                    console.error('Erro ao criar/mostrar o modal:', err);
                                }
                            } else {
                                console.error(`Elemento #popup${popupId} não encontrado no DOM`);
                            }
                        }, delay);
                    })({{ $popup->id }}, 500);
                } else {
                    console.log(`Popup #{{ $popup->id }} não será exibido pois foi recusado anteriormente`);
                }
            @endif
        @endforeach
    }
    
    // Verificar se o Bootstrap já está disponível
    if (bootstrapIsLoaded()) {
        showPopups();
    } else {
        var bootstrapCheckInterval = setInterval(function() {
            if (bootstrapIsLoaded()) {
                clearInterval(bootstrapCheckInterval);
                showPopups();
            }
        }, 100);
        
        setTimeout(function() {
            clearInterval(bootstrapCheckInterval);
            if (bootstrapIsLoaded()) {
                showPopups();
            }
        }, 3000);
    }
});

// Função para definir que não deve mostrar novamente
function doNotShowAgain(popupId) {
    const expires = new Date();
    expires.setTime(expires.getTime() + (24 * 60 * 60 * 1000)); // 24 horas
    
    document.cookie = `popup_dismissed_${popupId}=1; expires=${expires.toUTCString()}; path=/`;
    console.log(`Cookie definido para não mostrar o popup #${popupId} novamente`);
    
    // Fechar o modal atual
    const modalElement = document.getElementById('popup' + popupId);
    if (modalElement) {
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
            modalInstance.hide();
        }
    }
}
</script>
@endif

<!-- Script para banner de cookies LGPD -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se o usuário já fez uma escolha sobre cookies
    const cookieConsent = getCookie('cookie_consent');
    
    if (cookieConsent === null) {
        // Se não houver escolha anterior, mostrar o banner após um breve delay
        setTimeout(function() {
            const banner = document.getElementById('cookieConsentBanner');
            if (banner) {
                banner.classList.add('show');
            }
        }, 1000);
    }
});

// Função para aceitar cookies
function acceptCookies() {
    // Definir cookie de consentimento por 6 meses
    const sixMonths = 180 * 24 * 60 * 60 * 1000;
    const expires = new Date();
    expires.setTime(expires.getTime() + sixMonths);
    
    document.cookie = `cookie_consent=accepted; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
    
    // Esconder o banner
    const banner = document.getElementById('cookieConsentBanner');
    if (banner) {
        banner.classList.remove('show');
        
        // Remover completamente do DOM após a animação
        setTimeout(function() {
            banner.remove();
        }, 500);
    }
    
    // Evento de analytics (se aplicável)
    if (typeof gtag === 'function') {
        gtag('consent', 'update', {
            'analytics_storage': 'granted'
        });
    }
}

// Função para rejeitar cookies
function rejectCookies() {
    // Definir cookie de rejeição por 6 meses
    const sixMonths = 180 * 24 * 60 * 60 * 1000;
    const expires = new Date();
    expires.setTime(expires.getTime() + sixMonths);
    
    document.cookie = `cookie_consent=rejected; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
    
    // Esconder o banner
    const banner = document.getElementById('cookieConsentBanner');
    if (banner) {
        banner.classList.remove('show');
        
        // Remover completamente do DOM após a animação
        setTimeout(function() {
            banner.remove();
        }, 500);
    }
    
    // Evento de analytics (se aplicável)
    if (typeof gtag === 'function') {
        gtag('consent', 'update', {
            'analytics_storage': 'denied'
        });
    }
    
    // Limpar cookies não essenciais
    deleteCookies(['_ga', '_gid', '_gat', '_fbp']);
}

// Função para remover cookies específicos
function deleteCookies(cookieNames) {
    cookieNames.forEach(name => {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.${window.location.hostname};`;
    });
}

// Função para obter valor de cookie (reutilizando a mesma que já existe)
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}
</script>
@endpush

