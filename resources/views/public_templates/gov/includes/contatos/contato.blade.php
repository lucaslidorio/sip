@extends('public_templates.gov.layouts.app')

@section('title', 'Contato - ' . $tenant->nome)

@section('meta_description', 'Entre em contato com a ' . $tenant->nome . '. Telefone, email, endereço e redes sociais.
Formulário de contato online.')


@section('content')
<div class="contato-page">
    <!-- Header da Página -->
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="page-header-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('site.index') }}">
                                        <i class="fas fa-home"></i> Início
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="fas fa-envelope"></i> Contato
                                </li>
                            </ol>
                        </nav>
                        <h1 class="page-title">
                            <i class="fas fa-envelope me-3"></i>
                            Entre em Contato
                        </h1>
                        <p class="page-subtitle">
                            Estamos aqui para atender você. Escolha a melhor forma de entrar em contato conosco.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <div class="page-header-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Informações de Contato -->
    <section class="contact-info-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center mb-5">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle me-2"></i>
                            Informações de Contato
                        </h2>
                        <p class="section-subtitle">
                            Confira todos os nossos canais de atendimento
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Endereço -->
                @if($tenant->endereco)
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-content">
                            <h3 class="contact-title">Endereço</h3>
                            <p class="contact-text">{{ $tenant->endereco }}, {{ $tenant->numero }}, {{ $tenant->bairro
                                }}, {{ $tenant->cidade }}</p>

                            <a href="https://www.google.com/maps/search/?api=1&amp;query={{ urlencode(implode(', ', array_filter([
                            trim(($tenant->endereco ?? '').' '.($tenant->numero ?? '')),
                            $tenant->bairro ?? null, $tenant->cidade ?? null, $tenant->uf ?? null, $tenant->cep ?? null, 'Brasil'
                            ]))) }}" target="_blank" rel="noopener">
                                Ver no mapa
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Telefone -->
                @if($tenant->telefone)
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-content">
                            <h3 class="contact-title">Telefone</h3>
                            <p class="contact-text">{{ $tenant->telefone }}</p>
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $tenant->telefone) }}" class="contact-link">
                                <i class="fas fa-phone me-1"></i>
                                Ligar Agora
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Email -->
                @if($tenant->email)
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <h3 class="contact-title">Email</h3>
                            <p class="contact-text">{{ $tenant->email }}</p>
                            <a href="mailto:{{ $tenant->email }}" class="contact-link">
                                <i class="fas fa-envelope me-1"></i>
                                Enviar Email
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- WhatsApp -->
                @if($tenant->whatsapp)
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="contact-content">
                            <h3 class="contact-title">WhatsApp</h3>
                            <p class="contact-text">{{ $tenant->whatsapp }}</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $tenant->whatsapp) }}"
                                target="_blank" class="contact-link whatsapp-link">
                                <i class="fab fa-whatsapp me-1"></i>
                                Conversar
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Horário de Funcionamento -->
                @if($tenant->dia_atendimento)
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-content">
                            <h3 class="contact-title">Horário de Funcionamento</h3>
                            <p class="contact-text">{{ $tenant->dia_atendimento }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Redes Sociais -->
    @if($tenant->facebook || $tenant->instagram || $tenant->twitter || $tenant->tiktok || $tenant->youtube)
    <section class="social-media-section">
        <div class="container text-center pb-2">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center mb-4">
                        <h2 class="section-title">
                            <i class="fas fa-share-alt me-2"></i>
                            Redes Sociais
                        </h2>
                        <p class="section-subtitle">
                            Siga-nos nas redes sociais e fique por dentro das novidades
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="social-links">
                        @if($tenant->facebook)
                        <a href="{{ $tenant->facebook }}" target="_blank" class="social-link facebook" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                        @endif

                        @if($tenant->instagram)
                        <a href="{{ $tenant->instagram }}" target="_blank" class="social-link instagram"
                            title="Instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                        @endif

                        @if($tenant->twitter)
                        <a href="{{ $tenant->twitter }}" target="_blank" class="social-link twitter" title="Twitter">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                        @endif

                        @if($tenant->tiktok)
                        <a href="{{ $tenant->tiktok }}" target="_blank" class="social-link tiktok" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                            <span>TikTok</span>
                        </a>
                        @endif

                        @if($tenant->youtube)
                        <a href="{{ $tenant->youtube }}" target="_blank" class="social-link youtube" title="YouTube">
                            <i class="fab fa-youtube"></i>
                            <span>YouTube</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Formulário de Contato -->
    <section class="contact-form-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center mb-5">
                        <h2 class="section-title">
                            <i class="fas fa-paper-plane me-2"></i>
                            Envie sua Mensagem
                        </h2>
                        <p class="section-subtitle">
                            Preencha o formulário abaixo e entraremos em contato o mais breve possível
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Fechar"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Fechar"></button>
                        </div>
                        @endif

                        <form action="{{ route('site.contato.enviar') }}" method="POST" class="contact-form"
                            id="contactForm">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nome" class="form-label">
                                            <i class="fas fa-user me-1"></i>
                                            Nome Completo *
                                        </label>
                                        <input type="text" class="form-control @error('nome') is-invalid @enderror"
                                            id="nome" name="nome" value="{{ old('nome') }}" required maxlength="255"
                                            placeholder="Digite seu nome completo">
                                        @error('nome')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-1"></i>
                                            Email *
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" required maxlength="255"
                                            placeholder="Digite seu email">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefone" class="form-label">
                                            <i class="fas fa-phone me-1"></i>
                                            Telefone
                                        </label>
                                        <input type="tel" class="form-control @error('telefone') is-invalid @enderror"
                                            id="telefone" name="telefone" value="{{ old('telefone') }}" maxlength="20"
                                            placeholder="(00) 00000-0000">
                                        @error('telefone')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="assunto" class="form-label">
                                            <i class="fas fa-tag me-1"></i>
                                            Assunto
                                        </label>
                                        <select class="form-control @error('assunto') is-invalid @enderror" id="assunto"
                                            name="assunto">
                                            <option value="">Selecione um assunto</option>
                                            <option value="Informações Gerais" {{ old('assunto')=='Informações Gerais'
                                                ? 'selected' : '' }}>Informações Gerais</option>
                                            <option value="Serviços Públicos" {{ old('assunto')=='Serviços Públicos'
                                                ? 'selected' : '' }}>Serviços Públicos</option>
                                            <option value="Reclamação" {{ old('assunto')=='Reclamação' ? 'selected' : ''
                                                }}>Reclamação</option>
                                            <option value="Sugestão" {{ old('assunto')=='Sugestão' ? 'selected' : '' }}>
                                                Sugestão</option>
                                            <option value="Elogio" {{ old('assunto')=='Elogio' ? 'selected' : '' }}>
                                                Elogio</option>
                                            <option value="Transparência" {{ old('assunto')=='Transparência'
                                                ? 'selected' : '' }}>Transparência</option>
                                            <option value="Outros" {{ old('assunto')=='Outros' ? 'selected' : '' }}>
                                                Outros</option>
                                        </select>
                                        @error('assunto')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mensagem" class="form-label">
                                            <i class="fas fa-comment me-1"></i>
                                            Mensagem *
                                        </label>
                                        <textarea class="form-control @error('mensagem') is-invalid @enderror"
                                            id="mensagem" name="mensagem" rows="6" required maxlength="2000"
                                            placeholder="Digite sua mensagem...">{{ old('mensagem') }}</textarea>
                                        {{-- <div class="form-text">
                                            <span id="charCount">0</span>/2000 caracteres
                                        </div> --}}
                                        @error('mensagem')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input @error('aceito_termos') is-invalid @enderror"
                                            type="checkbox" id="aceito_termos" name="aceito_termos" value="1" {{
                                            old('aceito_termos') ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="aceito_termos">
                                            Aceito que meus dados sejam utilizados para resposta ao contato e declaro
                                            estar ciente da
                                            <a href="#" target="_blank">Política de Privacidade</a> *
                                        </label>
                                        @error('aceito_termos')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-triangle me-1"></i>
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        <span class="btn-text">Enviar Mensagem</span>
                                        <span class="btn-loading d-none">
                                            <i class="fas fa-spinner fa-spin me-2"></i>
                                            Enviando...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa (se houver coordenadas) -->
    @if($tenant->maps)
    <section class="map-section">
        <div class="container text-center">
            <div class="row">
                <div class="col-12">
                    <div class="section-header text-center mb-4">
                        <h2 class="section-title">
                            <i class="fas fa-map me-2"></i>
                            Nossa Localização
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="map-container">
                        {!! $tenant->maps !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection

@section('css')
<style>
    /* ===== PÁGINA DE CONTATO ===== */

    .contato-page {
        padding-top: 2rem;
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary-color, #28a745) 0%, var(--secondary-color, #20c997) 100%);
        color: white;
        padding: 4rem 0;
        margin-bottom: 4rem;
    }

    .page-header-content .breadcrumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 25px;
        padding: 0.5rem 1rem;
        margin-bottom: 1rem;
    }

    .page-header-content .breadcrumb-item a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
    }

    .page-header-content .breadcrumb-item.active {
        color: white;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
    }

    .page-header-icon {
        font-size: 6rem;
        opacity: 0.3;
    }

    /* Contact Info Section */
    .contact-info-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }

    .section-header {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 600;
        color: var(--primary-color, #28a745);
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
    }

    .contact-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .contact-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--primary-color, #28a745), var(--secondary-color, #20c997));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }

    .contact-icon.whatsapp {
        background: linear-gradient(135deg, #25D366, #128C7E);
    }

    .contact-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .contact-text {
        font-size: 1rem;
        color: #666;
        margin-bottom: 1rem;
    }

    .contact-detail {
        font-size: 0.9rem;
        color: #888;
        margin-bottom: 1rem;
    }

    .contact-link {
        color: var(--primary-color, #28a745);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .contact-link:hover {
        color: var(--secondary-color, #20c997);
    }

    .whatsapp-link {
        color: #25D366;
    }

    .whatsapp-link:hover {
        color: #128C7E;
    }

    /* Social Media Section */
    .social-media-section {
        padding: 4rem 0;
        background: white;
    }

    .social-links {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .social-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 1.5rem;
        border-radius: 50px;
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        min-width: 140px;
        justify-content: center;
    }

    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .social-link.facebook {
        background: linear-gradient(135deg, #1877F2, #42A5F5);
    }

    .social-link.instagram {
        background: linear-gradient(135deg, #E4405F, #FCAF45);
    }

    .social-link.twitter {
        background: linear-gradient(135deg, #1DA1F2, #0D8BD9);
    }

    .social-link.tiktok {
        background: linear-gradient(135deg, #000000, #FF0050);
    }

    .social-link.youtube {
        background: linear-gradient(135deg, #FF0000, #CC0000);
    }

    /* Contact Form Section */
    .contact-form-section {
        padding: 4rem 0;
        background: #f8f9fa;
    }

    .contact-form-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color, #28a745);
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        color: #dc3545;
        margin-top: 0.25rem;
    }

    .form-check {
        margin-bottom: 2rem;
    }

    .form-check-input:checked {
        background-color: var(--primary-color, #28a745);
        border-color: var(--primary-color, #28a745);
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #666;
    }

    .form-check-label a {
        color: var(--primary-color, #28a745);
        text-decoration: none;
    }

    .form-check-label a:hover {
        text-decoration: underline;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color, #28a745), var(--secondary-color, #20c997));
        border: none;
        border-radius: 50px;
        padding: 1rem 3rem;
        font-size: 1.1rem;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }

    .btn-primary:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .btn-loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Map Section */
    .map-section {
        padding: 4rem 0;
        background: white;
    }

    .map-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .contact-form-card {
            padding: 2rem 1.5rem;
        }

        .social-links {
            flex-direction: column;
            align-items: center;
        }

        .social-link {
            width: 100%;
            max-width: 250px;
        }
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 2rem 0;
        }

        .page-title {
            font-size: 1.8rem;
        }

        .contact-card {
            padding: 1.5rem;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('js')
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
    // Contador de caracteres



    // Máscara de telefone
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                if (value.length <= 10) {
                    value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                } else {
                    value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                }
            }
            
            e.target.value = value;
        });
    }
    
    // Submissão do formulário
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (contactForm && submitBtn) {
        contactForm.addEventListener('submit', function() {
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            
            if (btnText && btnLoading) {
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                submitBtn.disabled = true;
            }
        });
    }
    
    // Auto-hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 500);
            }
        }, 5000);
    });
});
</script>
@endsection