/**
 * Hero Carousel - Sistema de Carousel para Notícias em Destaque
 * Versão: 1.0.0
 * Compatível com: Bootstrap 5, acessibilidade WCAG 2.1
 */

class HeroCarousel {
    constructor(options = {}) {
        this.options = {
            autoplay: true,
            autoplayDelay: 5000,
            pauseOnHover: true,
            pauseOnFocus: true,
            enableKeyboard: true,
            enableTouch: true,
            enableIndicators: true,
            enableControls: true,
            transitionDuration: 800,
            ...options
        };

        this.carousel = document.getElementById('hero-carousel');
        this.slides = [];
        this.indicators = [];
        this.currentSlide = 0;
        this.totalSlides = 0;
        this.isPlaying = this.options.autoplay;
        this.autoplayTimer = null;
        this.progressTimer = null;
        this.isTransitioning = false;

        this.init();
    }

    init() {
        if (!this.carousel) {
            console.warn('Hero Carousel: Elemento carousel não encontrado');
            return;
        }

        this.setupSlides();
        this.setupControls();
        this.setupIndicators();
        this.setupEventListeners();
        this.setupAccessibility();
        
        if (this.options.autoplay && this.totalSlides > 1) {
            this.startAutoplay();
        }

        // Anunciar para leitores de tela
        this.announceSlide(this.currentSlide);
    }

    setupSlides() {
        this.slides = Array.from(this.carousel.querySelectorAll('.carousel-slide'));
        this.totalSlides = this.slides.length;

        if (this.totalSlides === 0) {
            console.warn('Hero Carousel: Nenhum slide encontrado');
            return;
        }

        // Configurar slides
        this.slides.forEach((slide, index) => {
            slide.setAttribute('aria-hidden', index !== this.currentSlide);
            slide.setAttribute('data-slide-index', index);
            
            // Adicionar role e labels para acessibilidade
            slide.setAttribute('role', 'tabpanel');
            slide.setAttribute('aria-label', `Slide ${index + 1} de ${this.totalSlides}`);
        });

        // Configurar slide ativo
        if (this.slides[this.currentSlide]) {
            this.slides[this.currentSlide].classList.add('active');
            this.slides[this.currentSlide].setAttribute('aria-hidden', 'false');
        }
    }

    setupControls() {
        if (!this.options.enableControls || this.totalSlides <= 1) return;

        this.prevBtn = document.getElementById('carousel-prev');
        this.nextBtn = document.getElementById('carousel-next');

        if (this.prevBtn && this.nextBtn) {
            this.prevBtn.setAttribute('aria-label', 'Slide anterior');
            this.nextBtn.setAttribute('aria-label', 'Próximo slide');
            
            this.prevBtn.addEventListener('click', () => this.prevSlide());
            this.nextBtn.addEventListener('click', () => this.nextSlide());
        }
    }

    setupIndicators() {
        if (!this.options.enableIndicators || this.totalSlides <= 1) return;

        this.indicators = Array.from(document.querySelectorAll('.carousel-indicator'));
        
        this.indicators.forEach((indicator, index) => {
            indicator.setAttribute('role', 'button');
            indicator.setAttribute('aria-label', `Ir para slide ${index + 1}`);
            indicator.setAttribute('tabindex', index === this.currentSlide ? '0' : '-1');
            
            indicator.addEventListener('click', () => this.goToSlide(index));
            indicator.addEventListener('keydown', (e) => this.handleIndicatorKeydown(e, index));
        });

        // Configurar indicador ativo
        if (this.indicators[this.currentSlide]) {
            this.indicators[this.currentSlide].classList.add('active');
            this.indicators[this.currentSlide].setAttribute('tabindex', '0');
        }
    }

    setupEventListeners() {
        // Pausar/retomar com hover
        if (this.options.pauseOnHover) {
            this.carousel.addEventListener('mouseenter', () => this.pauseAutoplay());
            this.carousel.addEventListener('mouseleave', () => this.resumeAutoplay());
        }

        // Pausar/retomar com foco
        if (this.options.pauseOnFocus) {
            this.carousel.addEventListener('focusin', () => this.pauseAutoplay());
            this.carousel.addEventListener('focusout', () => this.resumeAutoplay());
        }

        // Navegação por teclado
        if (this.options.enableKeyboard) {
            document.addEventListener('keydown', (e) => this.handleKeydown(e));
        }

        // Navegação por touch
        if (this.options.enableTouch) {
            this.setupTouchEvents();
        }

        // Pausar quando aba não está visível
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                this.pauseAutoplay();
            } else {
                this.resumeAutoplay();
            }
        });

        // Redimensionamento da janela
        window.addEventListener('resize', () => this.handleResize());
    }

    setupAccessibility() {
        // Configurar região live para anúncios
        this.liveRegion = document.createElement('div');
        this.liveRegion.setAttribute('aria-live', 'polite');
        this.liveRegion.setAttribute('aria-atomic', 'true');
        this.liveRegion.className = 'sr-only';
        document.body.appendChild(this.liveRegion);

        // Configurar controles de reprodução
        this.createPlayPauseButton();
    }

    createPlayPauseButton() {
        if (this.totalSlides <= 1) return;

        const playPauseBtn = document.createElement('button');
        playPauseBtn.className = 'carousel-play-pause';
        playPauseBtn.setAttribute('aria-label', this.isPlaying ? 'Pausar carousel' : 'Reproduzir carousel');
        playPauseBtn.innerHTML = this.isPlaying ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
        
        playPauseBtn.addEventListener('click', () => this.toggleAutoplay());
        
        // Adicionar ao carousel
        const controls = this.carousel.querySelector('.carousel-controls');
        if (controls) {
            controls.appendChild(playPauseBtn);
        }

        this.playPauseBtn = playPauseBtn;
    }

    setupTouchEvents() {
        let startX = 0;
        let startY = 0;
        let endX = 0;
        let endY = 0;
        let isDragging = false;

        this.carousel.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            isDragging = true;
            this.pauseAutoplay();
        }, { passive: true });

        this.carousel.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            endX = e.touches[0].clientX;
            endY = e.touches[0].clientY;
        }, { passive: true });

        this.carousel.addEventListener('touchend', () => {
            if (!isDragging) return;
            isDragging = false;

            const deltaX = endX - startX;
            const deltaY = endY - startY;
            const minSwipeDistance = 50;

            // Verificar se é um swipe horizontal
            if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > minSwipeDistance) {
                if (deltaX > 0) {
                    this.prevSlide();
                } else {
                    this.nextSlide();
                }
            }

            this.resumeAutoplay();
        }, { passive: true });
    }

    nextSlide() {
        if (this.isTransitioning) return;
        
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        this.goToSlide(nextIndex);
    }

    prevSlide() {
        if (this.isTransitioning) return;
        
        const prevIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        this.goToSlide(prevIndex);
    }

    goToSlide(index) {
        if (index === this.currentSlide || this.isTransitioning || index < 0 || index >= this.totalSlides) {
            return;
        }

        this.isTransitioning = true;
        const previousSlide = this.currentSlide;
        this.currentSlide = index;

        // Atualizar slides
        this.updateSlides(previousSlide);
        
        // Atualizar indicadores
        this.updateIndicators();
        
        // Anunciar mudança
        this.announceSlide(index);
        
        // Resetar autoplay
        if (this.isPlaying) {
            this.resetAutoplay();
        }

        // Remover flag de transição após animação
        setTimeout(() => {
            this.isTransitioning = false;
        }, this.options.transitionDuration);
    }

    updateSlides(previousIndex) {
        // Remover classes do slide anterior
        if (this.slides[previousIndex]) {
            this.slides[previousIndex].classList.remove('active');
            this.slides[previousIndex].setAttribute('aria-hidden', 'true');
        }

        // Adicionar classes ao slide atual
        if (this.slides[this.currentSlide]) {
            this.slides[this.currentSlide].classList.add('active');
            this.slides[this.currentSlide].setAttribute('aria-hidden', 'false');
        }
    }

    updateIndicators() {
        if (!this.options.enableIndicators) return;

        this.indicators.forEach((indicator, index) => {
            const isActive = index === this.currentSlide;
            
            indicator.classList.toggle('active', isActive);
            indicator.setAttribute('tabindex', isActive ? '0' : '-1');
            indicator.setAttribute('aria-selected', isActive);
            
            // Resetar animação de progresso
            const progress = indicator.querySelector('.indicator-progress');
            if (progress) {
                progress.style.animation = 'none';
                progress.offsetHeight; // Trigger reflow
                if (isActive && this.isPlaying) {
                    progress.style.animation = `progressBar ${this.options.autoplayDelay}ms linear`;
                }
            }
        });
    }

    announceSlide(index) {
        if (!this.liveRegion || !this.slides[index]) return;

        const slide = this.slides[index];
        const title = slide.querySelector('.slide-title')?.textContent || '';
        const description = slide.querySelector('.slide-description')?.textContent || '';
        
        const announcement = `Slide ${index + 1} de ${this.totalSlides}. ${title}. ${description}`;
        this.liveRegion.textContent = announcement;
    }

    startAutoplay() {
        if (this.totalSlides <= 1) return;
        
        this.isPlaying = true;
        this.updatePlayPauseButton();
        
        this.autoplayTimer = setInterval(() => {
            this.nextSlide();
        }, this.options.autoplayDelay);

        // Iniciar animação de progresso no indicador ativo
        this.startProgressAnimation();
    }

    pauseAutoplay() {
        this.isPlaying = false;
        this.updatePlayPauseButton();
        
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
            this.autoplayTimer = null;
        }

        this.pauseProgressAnimation();
    }

    resumeAutoplay() {
        if (this.options.autoplay && this.totalSlides > 1) {
            this.startAutoplay();
        }
    }

    resetAutoplay() {
        this.pauseAutoplay();
        this.resumeAutoplay();
    }

    toggleAutoplay() {
        if (this.isPlaying) {
            this.pauseAutoplay();
        } else {
            this.resumeAutoplay();
        }
    }

    updatePlayPauseButton() {
        if (!this.playPauseBtn) return;
        
        const isPlaying = this.isPlaying;
        this.playPauseBtn.setAttribute('aria-label', isPlaying ? 'Pausar carousel' : 'Reproduzir carousel');
        this.playPauseBtn.innerHTML = isPlaying ? '<i class="fas fa-pause"></i>' : '<i class="fas fa-play"></i>';
    }

    startProgressAnimation() {
        if (!this.indicators[this.currentSlide]) return;
        
        const progress = this.indicators[this.currentSlide].querySelector('.indicator-progress');
        if (progress && this.isPlaying) {
            progress.style.animation = `progressBar ${this.options.autoplayDelay}ms linear`;
        }
    }

    pauseProgressAnimation() {
        this.indicators.forEach(indicator => {
            const progress = indicator.querySelector('.indicator-progress');
            if (progress) {
                progress.style.animationPlayState = 'paused';
            }
        });
    }

    handleKeydown(e) {
        // Verificar se o foco está no carousel
        if (!this.carousel.contains(document.activeElement)) return;

        switch (e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                this.prevSlide();
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.nextSlide();
                break;
            case ' ':
            case 'Spacebar':
                e.preventDefault();
                this.toggleAutoplay();
                break;
            case 'Home':
                e.preventDefault();
                this.goToSlide(0);
                break;
            case 'End':
                e.preventDefault();
                this.goToSlide(this.totalSlides - 1);
                break;
        }
    }

    handleIndicatorKeydown(e, index) {
        switch (e.key) {
            case 'Enter':
            case ' ':
            case 'Spacebar':
                e.preventDefault();
                this.goToSlide(index);
                break;
            case 'ArrowLeft':
                e.preventDefault();
                const prevIndex = (index - 1 + this.totalSlides) % this.totalSlides;
                this.indicators[prevIndex].focus();
                break;
            case 'ArrowRight':
                e.preventDefault();
                const nextIndex = (index + 1) % this.totalSlides;
                this.indicators[nextIndex].focus();
                break;
            case 'Home':
                e.preventDefault();
                this.indicators[0].focus();
                break;
            case 'End':
                e.preventDefault();
                this.indicators[this.totalSlides - 1].focus();
                break;
        }
    }

    handleResize() {
        // Recalcular dimensões se necessário
        // Implementar lógica de redimensionamento se houver necessidade
    }

    destroy() {
        // Limpar timers
        if (this.autoplayTimer) {
            clearInterval(this.autoplayTimer);
        }

        // Remover event listeners
        document.removeEventListener('keydown', this.handleKeydown);
        document.removeEventListener('visibilitychange', this.handleVisibilityChange);
        window.removeEventListener('resize', this.handleResize);

        // Remover região live
        if (this.liveRegion && this.liveRegion.parentNode) {
            this.liveRegion.parentNode.removeChild(this.liveRegion);
        }

        // Limpar referências
        this.carousel = null;
        this.slides = [];
        this.indicators = [];
    }
}

// Inicialização automática quando DOM estiver carregado
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se existe carousel na página
    const carouselElement = document.getElementById('hero-carousel');
    if (carouselElement) {
        // Configurações personalizáveis
        const carouselOptions = {
            autoplay: true,
            autoplayDelay: 5000,
            pauseOnHover: true,
            pauseOnFocus: true,
            enableKeyboard: true,
            enableTouch: true,
            enableIndicators: true,
            enableControls: true,
            transitionDuration: 800
        };

        // Inicializar carousel
        window.heroCarousel = new HeroCarousel(carouselOptions);
        
        // Log para debug (remover em produção)
        console.log('Hero Carousel inicializado com sucesso');
    }
});

// Exportar classe para uso em módulos
if (typeof module !== 'undefined' && module.exports) {
    module.exports = HeroCarousel;
}

