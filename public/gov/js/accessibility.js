/* ===== JAVASCRIPT PARA FUNCIONALIDADES DE ACESSIBILIDADE ===== */

class AccessibilityManager {
    constructor() {
        this.currentFontSize = 16;
        this.isHighContrast = false;
        this.init();
    }

    init() {
        // Carregar preferências salvas
        this.loadPreferences();
        
        // Configurar event listeners
        this.setupEventListeners();
        
        // Aplicar preferências carregadas
        this.applyPreferences();
        
        // Configurar atalhos de teclado
        this.setupKeyboardShortcuts();
    }

    setupEventListeners() {
        // Botão aumentar fonte
        const increaseFontBtn = document.getElementById('increase-font');
        if (increaseFontBtn) {
            increaseFontBtn.addEventListener('click', () => this.increaseFontSize());
        }

        // Botão diminuir fonte
        const decreaseFontBtn = document.getElementById('decrease-font');
        if (decreaseFontBtn) {
            decreaseFontBtn.addEventListener('click', () => this.decreaseFontSize());
        }

        // Botão toggle contraste
        const toggleContrastBtn = document.getElementById('toggle-contrast');
        if (toggleContrastBtn) {
            toggleContrastBtn.addEventListener('click', () => this.toggleContrast());
        }

        // Botões alternativos (se existirem na página de acessibilidade)
        document.addEventListener('click', (e) => {
            if (e.target.matches('[onclick*="increaseFontSize"]')) {
                e.preventDefault();
                this.increaseFontSize();
            }
            if (e.target.matches('[onclick*="decreaseFontSize"]')) {
                e.preventDefault();
                this.decreaseFontSize();
            }
            if (e.target.matches('[onclick*="toggleContrast"]')) {
                e.preventDefault();
                this.toggleContrast();
            }
            if (e.target.matches('[onclick*="resetAccessibility"]')) {
                e.preventDefault();
                this.resetAccessibility();
            }
        });
    }

    increaseFontSize() {
        if (this.currentFontSize < 24) {
            this.currentFontSize += 2;
            this.applyFontSize();
            this.savePreferences();
            this.showFeedback('Fonte aumentada');
        } else {
            this.showFeedback('Tamanho máximo da fonte atingido');
        }
    }

    decreaseFontSize() {
        if (this.currentFontSize > 12) {
            this.currentFontSize -= 2;
            this.applyFontSize();
            this.savePreferences();
            this.showFeedback('Fonte diminuída');
        } else {
            this.showFeedback('Tamanho mínimo da fonte atingido');
        }
    }

    toggleContrast() {
        this.isHighContrast = !this.isHighContrast;
        this.applyContrast();
        this.savePreferences();
        
        const message = this.isHighContrast ? 'Alto contraste ativado' : 'Alto contraste desativado';
        this.showFeedback(message);
    }

    resetAccessibility() {
        this.currentFontSize = 16;
        this.isHighContrast = false;
        this.applyPreferences();
        this.savePreferences();
        this.showFeedback('Configurações de acessibilidade resetadas');
    }

    applyFontSize() {
        // Remove classes de fonte anteriores
        document.body.classList.remove('font-small', 'font-large', 'font-extra-large');
        
        // Aplica nova classe baseada no tamanho
        if (this.currentFontSize <= 14) {
            document.body.classList.add('font-small');
        } else if (this.currentFontSize >= 20) {
            document.body.classList.add('font-extra-large');
        } else if (this.currentFontSize >= 18) {
            document.body.classList.add('font-large');
        }
        
        // Também aplica via CSS custom property para maior controle
        document.documentElement.style.setProperty('--base-font-size', this.currentFontSize + 'px');
    }

    applyContrast() {
        if (this.isHighContrast) {
            document.body.classList.add('high-contrast');
        } else {
            document.body.classList.remove('high-contrast');
        }
        
        // Atualizar estado visual do botão
        const contrastBtn = document.getElementById('toggle-contrast');
        if (contrastBtn) {
            if (this.isHighContrast) {
                contrastBtn.classList.add('active');
                contrastBtn.setAttribute('aria-pressed', 'true');
            } else {
                contrastBtn.classList.remove('active');
                contrastBtn.setAttribute('aria-pressed', 'false');
            }
        }
    }

    applyPreferences() {
        this.applyFontSize();
        this.applyContrast();
    }

    savePreferences() {
        try {
            localStorage.setItem('accessibility-font-size', this.currentFontSize.toString());
            localStorage.setItem('accessibility-high-contrast', this.isHighContrast.toString());
        } catch (e) {
            console.warn('Não foi possível salvar preferências de acessibilidade:', e);
        }
    }

    loadPreferences() {
        try {
            const savedFontSize = localStorage.getItem('accessibility-font-size');
            if (savedFontSize) {
                this.currentFontSize = parseInt(savedFontSize, 10);
            }

            const savedContrast = localStorage.getItem('accessibility-high-contrast');
            if (savedContrast) {
                this.isHighContrast = savedContrast === 'true';
            }
        } catch (e) {
            console.warn('Não foi possível carregar preferências de acessibilidade:', e);
        }
    }

    showFeedback(message) {
        // Remove feedback anterior se existir
        const existingFeedback = document.querySelector('.accessibility-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }

        // Cria novo feedback
        const feedback = document.createElement('div');
        feedback.className = 'accessibility-feedback';
        feedback.textContent = message;
        feedback.setAttribute('role', 'status');
        feedback.setAttribute('aria-live', 'polite');
        
        // Estilos inline para garantir visibilidade
        Object.assign(feedback.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            background: 'var(--primary-color, #007bff)',
            color: 'white',
            padding: '12px 20px',
            borderRadius: '8px',
            fontSize: '14px',
            fontWeight: '500',
            zIndex: '9999',
            boxShadow: '0 4px 12px rgba(0, 0, 0, 0.15)',
            transform: 'translateX(100%)',
            transition: 'transform 0.3s ease',
            maxWidth: '300px',
            wordWrap: 'break-word'
        });

        document.body.appendChild(feedback);

        // Animar entrada
        setTimeout(() => {
            feedback.style.transform = 'translateX(0)';
        }, 10);

        // Remover após 3 segundos
        setTimeout(() => {
            feedback.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (feedback.parentNode) {
                    feedback.parentNode.removeChild(feedback);
                }
            }, 300);
        }, 3000);
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Atalhos com Alt + tecla
            if (e.altKey && !e.ctrlKey && !e.shiftKey) {
                switch (e.key.toLowerCase()) {
                    case '1':
                        e.preventDefault();
                        this.focusMainContent();
                        break;
                    case '2':
                        e.preventDefault();
                        this.focusNavigation();
                        break;
                    case '3':
                        e.preventDefault();
                        this.focusSearch();
                        break;
                    case '4':
                        e.preventDefault();
                        this.focusFooter();
                        break;
                    case '+':
                    case '=':
                        e.preventDefault();
                        this.increaseFontSize();
                        break;
                    case '-':
                        e.preventDefault();
                        this.decreaseFontSize();
                        break;
                    case 'c':
                        e.preventDefault();
                        this.toggleContrast();
                        break;
                    case 'r':
                        e.preventDefault();
                        this.resetAccessibility();
                        break;
                }
            }
        });
    }

    focusMainContent() {
        const main = document.querySelector('main, [role="main"], .main-content');
        if (main) {
            main.focus();
            main.scrollIntoView({ behavior: 'smooth', block: 'start' });
            this.showFeedback('Navegando para conteúdo principal');
        }
    }

    focusNavigation() {
        const nav = document.querySelector('nav, [role="navigation"], .navbar');
        if (nav) {
            nav.focus();
            nav.scrollIntoView({ behavior: 'smooth', block: 'start' });
            this.showFeedback('Navegando para menu principal');
        }
    }

    focusSearch() {
        const search = document.querySelector('input[type="search"], input[name*="search"], input[name*="pesquis"]');
        if (search) {
            search.focus();
            search.scrollIntoView({ behavior: 'smooth', block: 'center' });
            this.showFeedback('Navegando para campo de busca');
        }
    }

    focusFooter() {
        const footer = document.querySelector('footer, [role="contentinfo"]');
        if (footer) {
            footer.focus();
            footer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            this.showFeedback('Navegando para rodapé');
        }
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', () => {
    window.accessibilityManager = new AccessibilityManager();
});

// Funções globais para compatibilidade com código existente
function increaseFontSize() {
    if (window.accessibilityManager) {
        window.accessibilityManager.increaseFontSize();
    }
}

function decreaseFontSize() {
    if (window.accessibilityManager) {
        window.accessibilityManager.decreaseFontSize();
    }
}

function toggleContrast() {
    if (window.accessibilityManager) {
        window.accessibilityManager.toggleContrast();
    }
}

function resetAccessibility() {
    if (window.accessibilityManager) {
        window.accessibilityManager.resetAccessibility();
    }
}

// Adicionar estilos CSS dinamicamente se não estiverem incluídos
if (!document.querySelector('link[href*="accessibility-fix.css"]')) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '/gov/css/accessibility-fix.css';
    document.head.appendChild(link);
}

