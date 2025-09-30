{{-- Página de Detalhes do Processo de Compra --}}
@extends('public_templates.gov.layouts.app')

@section('title', $processo->objeto . ' | Processos de Compras')
@section('description', 'Detalhes do processo de compra ' . $processo->numero . ' - ' . $processo->objeto)

@section('content')
<div class="container section-padding">
    <div class="row">
        {{-- Conteúdo Principal (Col-lg-8) --}}
        <div class="col-lg-8">
            {{-- Cabeçalho da Página --}}
            <div class="page-header mb-4">
                <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                    {{ Breadcrumbs::render('processo', $processo) }}
                </ol>
                </nav>
                <h1 class="page-title h2">{{ $processo->objeto }}</h1>
                <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                    <span class="badge bg-primary me-2">
                        {{ $processo->modalidade->nome ?? 'N/A' }}
                    </span>
                    <span class="badge bg-{{ $processo->situacao_cor }}">
                        {{ $processo->situacao->nome ?? 'N/A' }}
                    </span>
                    <span class="badge bg-light text-dark">
                        Nº {{ $processo->numero }}
                    </span>
                </div>
            </div>
            
            {{-- Detalhes do Processo --}}
            <div class="processo-details card mb-4">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informações do Processo
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <strong class="d-block">Data de Publicação:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        {{ $processo->data_publicacao ? $processo->data_publicacao->format('d/m/Y H:i') : 'N/A' }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <strong class="d-block">Válido Até:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        {{ $processo->data_validade ? $processo->data_validade->format('d/m/Y H:i') : 'N/A' }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <strong class="d-block">Modalidade:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-file-contract me-2"></i>
                                        {{ $processo->modalidade->nome ?? 'N/A' }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <strong class="d-block">Critério de Julgamento:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-gavel me-2"></i>
                                        {{ $processo->criterio_julgamento->nome ?? 'N/A' }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3">
                                    <strong class="d-block">Situação Atual:</strong>
                                    <span class="badge bg-{{ $processo->situacao_cor }} fs-6">
                                        <i class="fas fa-info-circle me-1"></i>
                                        {{ $processo->situacao->nome ?? 'N/A' }}
                                    </span>
                                </li>
                                <li class="mb-3">
                                    <strong class="d-block">Total Credenciados:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-users me-2"></i>
                                        {{ $empresasCredenciadas->count() }} empresa(s)
                                    </span>
                                </li>
                                @if($processo->processo_origem)
                                <li class="mb-3">
                                    <strong class="d-block">Processo Origem:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-project-diagram me-2"></i>
                                        <a href="{{ route('site.compras.show', $processo->processo_origem) }}" class="text-decoration-none">
                                            {{ $processo->processoOrigem->numero ?? 'N/A' }}
                                        </a>
                                    </span>
                                </li>
                                @endif
                                @if($processo->email_contato)
                                <li class="mb-3">
                                    <strong class="d-block">Email para Contato:</strong>
                                    <span class="text-muted">
                                        <i class="fas fa-envelope me-2"></i>
                                        <a href="mailto:{{ $processo->email_contato }}">
                                            {{ $processo->email_contato }}
                                        </a>
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Descrição do Processo --}}
            @if($processo->descricao)
            <div class="processo-descricao card mb-4">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-align-left me-2"></i>
                        Descrição
                    </h2>
                </div>
                <div class="card-body">
                    <div class="processo-content">
                        {!! nl2br(e($processo->descricao)) !!}
                    </div>
                </div>
            </div>
            @endif
            
            {{-- Anexos/Documentos --}}
            @if($processo->anexos->count() > 0)
            <div class="processo-anexos card mb-4">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-paperclip me-2"></i>
                        Documentos Disponíveis
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Documento</th>
                                    <th class="text-center">Tamanho</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($processo->anexos as $anexo)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                            <span>{{ $anexo->nome }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">
                                            {{ $anexo->tamanho_formatado ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download me-1"></i>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
            
            {{-- Empresas Credenciadas --}}
            {{-- Lista de credenciados --}}
@if($empresasCredenciadas->count() > 0)
<div class="processo-credenciados card mb-4">
    <div class="card-header">
        <h2 class="h5 mb-0">
            <i class="fas fa-users me-2"></i>
            Empresas Credenciadas
            <span class="badge bg-success ms-2">{{ $empresasCredenciadas->count() }}</span>
        </h2>
        <small class="text-muted d-block mt-1">
            <i class="fas fa-shield-alt me-1"></i>
            Dados exibidos em conformidade com a Lei Geral de Proteção de Dados (LGPD)
        </small>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome/Razão Social</th>
                        <th>Documento</th>
                        <th class="text-center">Data Credenciamento</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresasCredenciadas as $credenciado)
                    <tr>
                        <td>
                            {{ $credenciado->nome_fantasia ?? $credenciado->razao_social ?? 'N/A' }}
                        </td>
                        <td>
                            @php
                                $documento = $credenciado->cnpj ?? $credenciado->cpf ?? null;
                                $tipoDoc = isset($credenciado->cnpj) ? 'CNPJ' : (isset($credenciado->cpf) ? 'CPF' : '');
                                
                                // Mascara o documento para exibir apenas parte dele
                                if ($documento) {
                                    if (strlen($documento) >= 14) {
                                        // CNPJ: Exibe apenas os 6 primeiros dígitos
                                        $docFormatado = substr($documento, 0, 6) . '***.***/****-**';
                                    } else {
                                        // CPF: Exibe apenas os 3 primeiros dígitos
                                        $docFormatado = substr($documento, 0, 3) . '.***.***.***-**';
                                    }
                                } else {
                                    $docFormatado = 'N/A';
                                }
                            @endphp
                            
                            <span title="Documento parcialmente oculto em conformidade com a LGPD">
                                {{ $tipoDoc ? $tipoDoc . ': ' : '' }}{{ $docFormatado }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($credenciado->data_credenciamento)->format('d/m/Y H:i:s') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <p class="text-muted small mb-0">
                <i class="fas fa-info-circle me-1"></i>
                Por medidas de proteção de dados pessoais e em conformidade com a LGPD (Lei nº 13.709/2018), 
                os documentos são exibidos parcialmente.
            </p>
        </div>
    </div>
</div>
@endif          
          
            
            {{-- Compartilhamento e Navegação --}}
            <div class="processo-actions mt-5 pt-4 border-top">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-3">
                        <a href="{{ route('site.compras.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Voltar para Lista
                        </a>
                    </div>
                    <div class="share-buttons d-flex gap-2 mb-3">
                        <button type="button" 
                                class="btn btn-outline-secondary" 
                                onclick="copyToClipboard(event, '{{ request()->fullUrl() }}')">
                            <i class="fas fa-link me-1"></i> Copiar Link
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar (Col-lg-4) --}}
        <div class="col-lg-4">
            <aside class="sidebar">
                {{-- Acesso Rápido --}}
                @include('public_templates.gov.includes.acesso-rapido')
                
                {{-- Status do Processo --}}
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Status do Processo
                    </h3>
                    <div class="processo-status">
                        <div class="status-indicator mb-4">
                            <div class="progress mb-3" style="height: 8px;">
                                @php
                                    // Calculando o progresso com base no status atual
                                    // Você pode ajustar conforme sua lógica de negócios
                                    $progresso = match($processo->situacao_id ?? 0) {
                                        33 => 33, // Recebendo propostas
                                        34 => 66, // Em andamento
                                        35 => 100, // Homologado
                                        36 => 0, // Cancelado
                                        default => 0
                                    };
                                @endphp
                                <div class="progress-bar bg-{{ $processo->situacao_cor ?? 'secondary' }}" 
                                     role="progressbar" 
                                     style="width: {{ $progresso }}%" 
                                     aria-valuenow="{{ $progresso }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between text-muted">
                                <small>Início</small>
                                <small>Em Processo</small>
                                <small>Finalizado</small>
                            </div>
                        </div>
                        
                        <div class="status-current mb-3">
                            <h5 class="status-title">Situação Atual</h5>
                            <div class="d-flex align-items-center gap-3">
                                <div class="status-icon bg-{{ $processo->situacao_cor ?? 'secondary' }}">
                                    <i class="fas fa-{{ $processo->situacao_id == 35 ? 'check-circle' : ($processo->situacao_id == 36 ? 'times-circle' : 'hourglass-half') }}"></i>
                                </div>
                                <div class="status-info">
                                    <h6 class="status-name mb-0">{{ $processo->situacao->nome ?? 'N/A' }}</h6>
                                    @if($processo->situacao_id == 33)
                                    <small class="text-muted">Recebendo documentos e propostas</small>
                                    @elseif($processo->situacao_id == 35)
                                    <small class="text-muted">Processo finalizado com sucesso</small>
                                    @elseif($processo->situacao_id == 36)
                                    <small class="text-muted">Processo foi cancelado</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="status-dates">
                            <div class="date-item mb-2">
                                <strong class="d-block text-muted">Publicação:</strong>
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $processo->data_publicacao ? $processo->data_publicacao->format('d/m/Y') : 'N/A' }}
                            </div>
                            
                            <div class="date-item">
                                <strong class="d-block text-muted">Válido Até:</strong>
                                <i class="fas fa-calendar-check me-1"></i>
                                {{ $processo->data_validade ? $processo->data_validade->format('d/m/Y') : 'N/A' }}
                            </div>
                            
                            @if($processo->situacao_id == 35)
                            <div class="date-item mt-2">
                                <strong class="d-block text-muted">Homologação:</strong>
                                <i class="fas fa-check-circle me-1"></i>
                                {{ $processo->data_homologacao ? $processo->data_homologacao->format('d/m/Y') : 'N/A' }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Processos Relacionados --}}
                @if(isset($processosRelacionados) && $processosRelacionados->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-project-diagram me-2"></i>
                        Processos Relacionados
                    </h3>
                    <div class="list-group">
                        @foreach($processosRelacionados as $relacionado)
                        <a href="{{ route('site.compras.show', $relacionado->id) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <span class="d-block fw-bold">{{ $relacionado->numero }}</span>
                                <small class="text-truncate d-block" style="max-width: 200px;">{{ $relacionado->objeto }}</small>
                            </div>
                            <span class="badge bg-{{ $relacionado->situacao_cor ?? 'secondary' }}">
                                {{ $relacionado->situacao->nome ?? 'N/A' }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Contato -->
                @include('public_templates.gov.includes.contato-lateral')
                
                <!-- Links Úteis Lateral -->
                @include('public_templates.gov.includes.links-uteis-lateral')
                
                {{-- Widget - Compartilhar --}}
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">
                        <i class="fas fa-share-alt me-2"></i>
                        Compartilhar
                    </h3>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-outline-primary btn-sm mb-2">
                            <i class="fab fa-facebook-f me-1"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($processo->objeto . ' - ' . $tenant->nome) }}" target="_blank" class="btn btn-outline-info btn-sm mb-2">
                            <i class="fab fa-twitter me-1"></i> Twitter
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($processo->objeto . ' - ' . $tenant->nome . ': ' . request()->fullUrl()) }}" target="_blank" class="btn btn-outline-success btn-sm mb-2">
                            <i class="fab fa-whatsapp me-1"></i> WhatsApp
                        </a>
                        <button type="button" 
                                class="btn btn-outline-secondary btn-sm mb-2" 
                                onclick="copyToClipboard(event, '{{ request()->fullUrl() }}')">
                            <i class="fas fa-link me-1"></i> Copiar Link
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

{{-- CSS Específico --}}
@push('styles')
<style>
/* Estilos Sidebar */
.sidebar-widget {
    margin-bottom: 2rem;
    background: #fff;
    border-radius: var(--border-radius-lg, 0.5rem);
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.sidebar-widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color, #0d6efd);
    color: var(--text-primary, #333);
}

/* Status do Processo */
.status-current {
    border-left: 4px solid var(--primary-color, #0d6efd);
    padding-left: 1rem;
}

.status-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 1.5rem;
}

.timeline:before {
    content: '';
    position: absolute;
    left: 0.75rem;
    top: 0;
    height: 100%;
    width: 2px;
    background: var(--gray-200, #e9ecef);
}

.timeline-item {
    position: relative;
    padding-bottom: 1.5rem;
}

.timeline-marker {
    position: absolute;
    left: -1.5rem;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    z-index: 1;
}

.timeline-content {
    padding-left: 0.5rem;
}

.timeline-title {
    margin-bottom: 0.25rem;
}

/* Botões de Compartilhamento */
.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.share-buttons .btn {
    flex: 1 0 calc(50% - 0.5rem);
}

/* Contato */
.contact-info p {
    margin-bottom: 0.75rem;
}

.contact-info a {
    color: var(--primary-color, #0d6efd);
    text-decoration: none;
}

.contact-info a:hover {
    text-decoration: underline;
}

/* Lista */
.list-group-item {
    border-radius: var(--border-radius-md, 0.25rem) !important;
    margin-bottom: 0.25rem;
    border: 1px solid var(--gray-200, #e9ecef);
    transition: all 0.2s ease;
}

.list-group-item:hover {
    background-color: var(--gray-100, #f8f9fa);
    border-color: var(--primary-color, #0d6efd);
}

/* Responsividade */
@media (max-width: 992px) {
    .sidebar {
        margin-top: 2rem;
    }
}
</style>
@endpush

@endsection

