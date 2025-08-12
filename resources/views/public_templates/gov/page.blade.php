@extends('public_templates.gov.layouts.app')

@section('title', $page->titulo . ' - ' . $tenant->nome)
@section('description', Str::limit(strip_tags($page->conteudo), 160))

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
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $page->titulo }}
                    </li>
                </ol>
            </nav>

            <!-- Conteúdo da Página -->
            <article class="page-content">
                <header class="page-header mb-4">
                    <h1 class="page-title text-primary-color">{{ $page->titulo }}</h1>
                    
                    @if($page->subtitulo)
                    <p class="page-subtitle text-muted">{{ $page->subtitulo }}</p>
                    @endif
                    
                    <div class="page-meta text-muted small">
                        <i class="fas fa-calendar me-1"></i>
                        Atualizado em {{ $page->updated_at->format('d/m/Y') }}
                    </div>
                </header>

                @if($page->imagem)
                <div class="page-image mb-4">
                    <img src="{{ asset('storage/' . $page->imagem) }}" 
                         alt="{{ $page->titulo }}" 
                         class="img-fluid rounded shadow-sm">
                </div>
                @endif

                <div class="page-body">
                    {!! $page->conteudo !!}
                </div>

                @if($page->anexos && $page->anexos->count() > 0)
                <div class="page-attachments mt-5">
                    <h3 class="h5 text-primary-color mb-3">
                        <i class="fas fa-paperclip me-2"></i>
                        Anexos
                    </h3>
                    
                    <div class="list-group">
                        @foreach($page->anexos as $anexo)
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
            </article>

            <!-- Compartilhamento -->
            <div class="page-share mt-5 pt-4 border-top">
                <h4 class="h6 text-muted mb-3">Compartilhar esta página:</h4>
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                       target="_blank" 
                       class="btn btn-outline-primary btn-sm">
                        <i class="fab fa-facebook-f me-1"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($page->titulo) }}" 
                       target="_blank" 
                       class="btn btn-outline-info btn-sm">
                        <i class="fab fa-twitter me-1"></i> Twitter
                    </a>
                    <a href="https://wa.me/?text={{ urlencode($page->titulo . ' - ' . request()->fullUrl()) }}" 
                       target="_blank" 
                       class="btn btn-outline-success btn-sm">
                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                    </a>
                    <button type="button" 
                            class="btn btn-outline-secondary btn-sm" 
                            onclick="copyToClipboard('{{ request()->fullUrl() }}')">
                        <i class="fas fa-link me-1"></i> Copiar Link
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="page-sidebar">
                <!-- Menu de Navegação -->
                @if($menus && $menus->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Navegação</h3>
                    <div class="list-group">
                        @foreach($menus->take(8) as $menu)
                        <a href="{{ $menu->url }}" 
                           class="list-group-item list-group-item-action {{ request()->url() === $menu->url ? 'active' : '' }}">
                            @if($menu->icone)
                            <i class="{{ $menu->icone }} me-2"></i>
                            @endif
                            {{ $menu->nome }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Acesso Rápido -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Acesso Rápido</h3>
                    <div class="d-grid gap-2">
                        <a href="{{ route('site.noticias.todas') }}" class="btn btn-outline-primary">
                            <i class="fas fa-newspaper me-2"></i> Notícias
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
                        @if($tenant->endereco)
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            {{ $tenant->endereco }}
                        </p>
                        @endif
                        
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
                        
                        @if($tenant->horario_funcionamento)
                        <p class="mb-0">
                            <i class="fas fa-clock text-primary me-2"></i>
                            {{ $tenant->horario_funcionamento }}
                        </p>
                        @endif
                    </div>
                </div>

                <!-- Banner Lateral -->
                @if($linksDireita && $linksDireita->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Links Úteis</h3>
                    @foreach($linksDireita->take(4) as $link)
                    <div class="mb-3">
                        <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                            @if($link->imagem)
                            <img src="{{ asset('storage/' . $link->imagem) }}" 
                                 alt="{{ $link->titulo }}" 
                                 class="img-fluid rounded shadow-sm">
                            @else
                            <div class="card">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $link->titulo }}</h6>
                                    @if($link->descricao)
                                    <p class="card-text small">{{ $link->descricao }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </aside>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.page-body h2,
.page-body h3,
.page-body h4 {
    color: var(--primary-color);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.page-body img {
    max-width: 100%;
    height: auto;
    border-radius: var(--border-radius-md);
    box-shadow: var(--shadow-sm);
    margin: 1rem 0;
}

.page-body blockquote {
    border-left: 4px solid var(--primary-color);
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    background-color: var(--primary-lighter);
    padding: 1rem;
    border-radius: var(--border-radius-md);
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

.contact-info p {
    font-size: 0.95rem;
}

.contact-info a {
    color: var(--text-primary);
    text-decoration: none;
}

.contact-info a:hover {
    color: var(--primary-color);
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
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

