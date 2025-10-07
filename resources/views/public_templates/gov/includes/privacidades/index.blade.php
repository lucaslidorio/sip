{{-- Política de Privacidade Simples - Prefeitura Municipal --}}
@extends('public_templates.gov.layouts.app')

@section('title', 'Política de Privacidade')
@section('description', 'Política de Privacidade e Proteção de Dados da Prefeitura Municipal')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            {{-- Cabeçalho --}}
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold text-primary mb-3">
                    <i class="fas fa-shield-alt me-3"></i>
                    Política de Privacidade
                </h1>
                <p class="lead text-muted">
                    Proteção de Dados Pessoais em conformidade com a Lei Geral de Proteção de Dados (LGPD)
                </p>
                <div class="text-muted">
                    <small>
                        <i class="fas fa-calendar me-1"></i>
                        Última atualização: {{ date('d/m/Y') }}
                    </small>
                </div>
            </div>

            {{-- Conteúdo Principal --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-5">
                    <div class="privacy-content">
                        
                        <p class="lead">
                            A <strong>Prefeitura Municipal de {{ $tenant->nome}}</strong>, 
                            inscrita no CNPJ {{ $tenant->cnpj}}, está comprometida com a proteção 
                            da privacidade e dos dados pessoais dos cidadãos, em conformidade com a 
                            <strong>Lei nº 13.709/2018 (Lei Geral de Proteção de Dados - LGPD)</strong>.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Dados Coletados</h3>
                        <p>
                            Coletamos dados pessoais quando você utiliza nossos serviços, como nome, CPF, RG, 
                            endereço, telefone, e-mail e outras informações necessárias para a prestação de 
                            serviços públicos municipais. Durante a navegação no site, também coletamos 
                            informações técnicas como endereço IP, tipo de navegador e páginas visitadas.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Finalidade do Uso</h3>
                        <p>
                            Utilizamos seus dados pessoais exclusivamente para:
                        </p>
                        <ul class="list-unstyled ms-3">
                            <li><i class="fas fa-check text-success me-2"></i>Prestação de serviços públicos municipais</li>
                            <li><i class="fas fa-check text-success me-2"></i>Atendimento ao cidadão e processamento de solicitações</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cumprimento de obrigações legais e regulamentares</li>
                            <li><i class="fas fa-check text-success me-2"></i>Comunicação institucional e divulgação de informações públicas</li>
                            <li><i class="fas fa-check text-success me-2"></i>Melhoria dos serviços oferecidos à população</li>
                            <li><i class="fas fa-check text-success me-2"></i>Garantia da transparência pública</li>
                        </ul>

                        <h3 class="h4 text-primary mt-5 mb-3">Base Legal</h3>
                        <p>
                            O tratamento dos seus dados pessoais é fundamentado nas seguintes bases legais 
                            previstas na LGPD: execução de políticas públicas, cumprimento de obrigação legal, 
                            execução de contrato, interesse público e, quando aplicável, seu consentimento.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Compartilhamento</h3>
                        <p>
                            Seus dados podem ser compartilhados com outros órgãos públicos quando necessário 
                            para a execução de políticas públicas, cumprimento de obrigações legais ou por 
                            determinação judicial. Também podem ser compartilhados com empresas contratadas 
                            para prestação de serviços técnicos, sempre mediante contrato que garanta a 
                            proteção adequada. <strong>Não vendemos, alugamos ou comercializamos dados pessoais.</strong>
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Segurança</h3>
                        <p>
                            Adotamos medidas técnicas e organizacionais adequadas para proteger seus dados 
                            pessoais contra acesso não autorizado, alteração, divulgação ou destruição. 
                            Isso inclui criptografia, controle de acesso, servidores seguros, backup regular 
                            e treinamento de funcionários.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Seus Direitos</h3>
                        <p>
                            Como titular de dados pessoais, você tem direito a:
                        </p>
                        <ul class="list-unstyled ms-3">
                            <li><i class="fas fa-user-check text-primary me-2"></i>Confirmar a existência de tratamento dos seus dados</li>
                            <li><i class="fas fa-eye text-primary me-2"></i>Acessar seus dados pessoais</li>
                            <li><i class="fas fa-edit text-primary me-2"></i>Corrigir dados incompletos, inexatos ou desatualizados</li>
                            <li><i class="fas fa-download text-primary me-2"></i>Solicitar a portabilidade dos dados</li>
                            <li><i class="fas fa-times-circle text-primary me-2"></i>Solicitar a eliminação de dados desnecessários</li>
                            <li><i class="fas fa-info-circle text-primary me-2"></i>Obter informações sobre compartilhamento</li>
                            <li><i class="fas fa-ban text-primary me-2"></i>Opor-se ao tratamento quando baseado em interesse legítimo</li>
                        </ul>

                        <h3 class="h4 text-primary mt-5 mb-3">Cookies</h3>
                        <p>
                            Nosso site utiliza cookies técnicos essenciais para o funcionamento adequado 
                            e cookies analíticos para melhorar a experiência do usuário. Você pode 
                            gerenciar suas preferências de cookies através das configurações do seu navegador.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Retenção de Dados</h3>
                        <p>
                            Mantemos seus dados pessoais pelo tempo necessário para as finalidades para as 
                            quais foram coletados, respeitando os prazos legais de guarda de documentos 
                            públicos e as necessidades para cumprimento de obrigações legais.
                        </p>

                        <h3 class="h4 text-primary mt-5 mb-3">Alterações</h3>
                        <p>
                            Esta Política de Privacidade pode ser atualizada periodicamente. Recomendamos 
                            a consulta regular desta página. Alterações significativas serão comunicadas 
                            através do nosso site oficial.
                        </p>

                        {{-- Seção de Contato --}}
                        <div class="contact-section mt-5 p-4 bg-light rounded">
                            <h3 class="h4 text-primary mb-4">
                                <i class="fas fa-envelope me-2"></i>
                                Como Exercer seus Direitos
                            </h3>
                            <p class="mb-4">
                                Para exercer qualquer um dos seus direitos ou esclarecer dúvidas sobre 
                                esta política, entre em contato conosco:
                            </p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Encarregado de Proteção de Dados (DPO)</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <a href="mailto:{{ config('app.email_dpo', 'dpo@prefeitura.gov.br') }}">
                                                {{ config('app.email_dpo', 'dpo@prefeitura.gov.br') }}
                                            </a>
                                        </li>
                                        <li>
                                            <i class="fas fa-phone text-primary me-2"></i>
                                            {{ config('app.telefone', '(XX) XXXX-XXXX') }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold">Prefeitura Municipal</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                            {{ config('app.endereco', '[Endereço da Prefeitura]') }}
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope text-primary me-2"></i>
                                            <a href="mailto:{{ config('app.email_contato', 'contato@prefeitura.gov.br') }}">
                                                {{ config('app.email_contato', 'contato@prefeitura.gov.br') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="mt-4 p-3 bg-white rounded border-start border-primary border-4">
                                <h6 class="fw-bold text-primary mb-2">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Autoridade Nacional de Proteção de Dados (ANPD)
                                </h6>
                                <p class="mb-0 small">
                                    Em caso de não resolução de questões relacionadas aos seus dados pessoais, 
                                    você pode contatar a ANPD através do site: 
                                    <a href="https://www.gov.br/anpd" target="_blank" class="text-primary">
                                        www.gov.br/anpd
                                    </a>
                                </p>
                            </div>
                        </div>

                        {{-- Rodapé da Política --}}
                        <div class="text-center mt-5 pt-4 border-top">
                            <p class="text-muted mb-2">
                                <strong>Prefeitura Municipal de {{ $tenant->nome }}</strong>
                            </p>
                            <p class="text-muted small mb-0">
                                CNPJ: {{$tenant->cnpj }} | 
                                Última atualização: {{ date('d/m/Y') }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Botões de Ação --}}
            <div class="text-center mt-4">
                <button class="btn btn-outline-primary me-3" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>
                    Imprimir
                </button>
                <a href="{{ route('site.index') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>
                    Voltar ao Início
                </a>
            </div>

        </div>
    </div>
</div>

{{-- CSS Específico --}}
@push('styles')
<style>
/* Estilos para a política de privacidade simples */
.privacy-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #374151;
}

.privacy-content h3 {
    font-weight: 600;
    border-bottom: 2px solid var(--primary-color, #059669);
    padding-bottom: 0.5rem;
    margin-bottom: 1.5rem;
}

.privacy-content p {
    text-align: justify;
    margin-bottom: 1.5rem;
}

.privacy-content ul li {
    margin-bottom: 0.8rem;
    padding-left: 0.5rem;
}

.contact-section {
    border: 1px solid #e5e7eb;
}

.contact-section h6 {
    color: var(--primary-color, #059669);
    margin-bottom: 1rem;
}

.contact-section ul li {
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.contact-section a {
    color: var(--primary-color, #059669);
    text-decoration: none;
}

.contact-section a:hover {
    text-decoration: underline;
}

/* Responsividade */
@media (max-width: 768px) {
    .privacy-content {
        font-size: 1rem;
        line-height: 1.6;
    }
    
    .privacy-content h3 {
        font-size: 1.3rem;
    }
    
    .contact-section .row {
        text-align: center;
    }
    
    .contact-section .col-md-6 {
        margin-bottom: 2rem;
    }
}

/* Print styles */
@media print {
    .btn, .contact-section {
        display: none !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    
    .privacy-content {
        font-size: 12pt;
        line-height: 1.5;
    }
    
    .privacy-content h3 {
        page-break-after: avoid;
        border-bottom: 1px solid #000;
    }
    
    .privacy-content p {
        text-align: left;
    }
}

/* Animação suave */
.card {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Destaque para links importantes */
.privacy-content a {
    color: var(--primary-color, #059669);
    font-weight: 500;
    text-decoration: none;
}

.privacy-content a:hover {
    text-decoration: underline;
}

/* Ícones coloridos */
.fas.text-success {
    color: #10b981 !important;
}

.fas.text-primary {
    color: var(--primary-color, #059669) !important;
}

/* Espaçamento melhorado */
.privacy-content > *:last-child {
    margin-bottom: 0;
}

/* Botões estilizados */
.btn {
    border-radius: 0.5rem;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-primary {
    background: var(--primary-color, #059669);
    border-color: var(--primary-color, #059669);
}

.btn-primary:hover {
    background: var(--primary-dark, #047857);
    border-color: var(--primary-dark, #047857);
}
</style>
@endpush

{{-- JavaScript (opcional) --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para links internos (se houver)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Registrar visualização da política (opcional)
    if (typeof gtag !== 'undefined') {
        gtag('event', 'page_view', {
            page_title: 'Política de Privacidade',
            page_location: window.location.href
        });
    }
});
</script>
@endpush
@endsection

