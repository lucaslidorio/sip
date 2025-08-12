/* ===== JAVASCRIPT PARA MENU MODERNO E INTERATIVO ===== */

class ModernMenuManager {
    constructor() {
        this.navbar = document.getElementById('mainNavbar');
        this.navbarToggler = document.querySelector('.navbar-toggler');
        this.dropdowns = document.querySelectorAll('.dropdown');
        this.megaMenus = document.querySelectorAll('.mega-menu');
        this.scrollThreshold = 100;
        this.isScrolled = false;
        
        this.init();
    }

    init() {
        this.setupScrollEffects();
        this.setupDropdownEffects();
        this.setupMegaMenuEffects();
        this.setupMobileMenu();
        this.setupKeyboardNavigation();
        this.setupActiveStates();
        this.setupSmoothScrolling();
    }

    setupScrollEffects() {
        let ticking = false;
        
        const handleScroll = () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    const scrolled = window.scrollY > this.scrollThreshold;
                    
                    if (scrolled !== this.isScrolled) {
                        this.isScrolled = scrolled;
                        this.navbar.classList.toggle('scrolled', scrolled);
                        
                        // Adicionar efeito de compressão quando scrolled
                        if (scrolled) {
                            this.navbar.style.transform = 'scaleY(0.95)';
                            setTimeout(() => {
                                this.navbar.style.transform = 'scaleY(1)';
                            }, 150);
                        }
                    }
                    
                    ticking = false;
                });
                ticking = true;
            }
        };

        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    setupDropdownEffects() {
        this.dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');
            let hoverTimeout;

            if (!dropdown.classList.contains('mega-menu')) {
                // Hover effects para dropdowns normais
                dropdown.addEventListener('mouseenter', () => {
                    clearTimeout(hoverTimeout);
                    this.showDropdown(dropdown, menu);
                });

                dropdown.addEventListener('mouseleave', () => {
                    hoverTimeout = setTimeout(() => {
                        this.hideDropdown(dropdown, menu);
                    }, 300);
                });

                // Click effects para mobile
                toggle.addEventListener('click', (e) => {
                    if (window.innerWidth <= 991) {
                        e.preventDefault();
                        this.toggleDropdown(dropdown, menu);
                    }
                });
            }
        });
    }

    setupMegaMenuEffects() {
        this.megaMenus.forEach(megaMenu => {
            const toggle = megaMenu.querySelector('.dropdown-toggle');
            const menu = megaMenu.querySelector('.dropdown-menu');
            let hoverTimeout;

            megaMenu.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
                this.showMegaMenu(megaMenu, menu);
            });

            megaMenu.addEventListener('mouseleave', () => {
                hoverTimeout = setTimeout(() => {
                    this.hideMegaMenu(megaMenu, menu);
                }, 500);
            });

            // Animação especial para mega menu items
            const menuItems = menu.querySelectorAll('.dropdown-item');
            menuItems.forEach((item, index) => {
                item.addEventListener('mouseenter', () => {
                    item.style.transitionDelay = '0ms';
                    item.style.transform = 'translateX(8px) scale(1.02)';
                });

                item.addEventListener('mouseleave', () => {
                    item.style.transitionDelay = '0ms';
                    item.style.transform = 'translateX(0) scale(1)';
                });
            });
        });
    }

    setupMobileMenu() {
        this.navbarToggler.addEventListener('click', () => {
            const isExpanded = this.navbarToggler.getAttribute('aria-expanded') === 'true';
            
            // Animação do ícone hamburger
            this.animateHamburgerIcon(!isExpanded);
            
            // Efeito no collapse
            const collapse = document.getElementById('navbarMain');
            if (collapse) {
                collapse.addEventListener('shown.bs.collapse', () => {
                    this.animateMenuItems();
                });
            }
        });

        // Fechar menu ao clicar em link (mobile)
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 991) {
                    const collapse = bootstrap.Collapse.getInstance(document.getElementById('navbarMain'));
                    if (collapse) {
                        collapse.hide();
                    }
                }
            });
        });
    }

    setupKeyboardNavigation() {
        const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
        
        navLinks.forEach(link => {
            link.addEventListener('keydown', (e) => {
                switch (e.key) {
                    case 'Enter':
                    case ' ':
                        if (link.classList.contains('dropdown-toggle')) {
                            e.preventDefault();
                            this.toggleDropdownKeyboard(link);
                        }
                        break;
                    case 'Escape':
                        this.closeAllDropdowns();
                        link.blur();
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        this.navigateToNext(link);
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        this.navigateToPrevious(link);
                        break;
                }
            });
        });
    }

    setupActiveStates() {
        // Destacar item ativo baseado na URL atual
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && (href === currentPath || currentPath.startsWith(href + '/'))) {
                link.classList.add('active');
                
                // Se for um dropdown item, também ativar o parent
                const dropdown = link.closest('.dropdown');
                if (dropdown) {
                    const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                    if (dropdownToggle) {
                        dropdownToggle.classList.add('active');
                    }
                }
            }
        });
    }

    setupSmoothScrolling() {
        // Smooth scroll para links internos
        const internalLinks = document.querySelectorAll('a[href^="#"]');
        internalLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                const targetId = link.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    const offsetTop = targetElement.offsetTop - this.navbar.offsetHeight - 20;
                    
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    showDropdown(dropdown, menu) {
        dropdown.classList.add('show');
        menu.classList.add('show');
        menu.style.opacity = '1';
        menu.style.transform = 'translateY(0) scale(1)';
        menu.style.pointerEvents = 'all';
    }

    hideDropdown(dropdown, menu) {
        dropdown.classList.remove('show');
        menu.classList.remove('show');
        menu.style.opacity = '0';
        menu.style.transform = 'translateY(-10px) scale(0.95)';
        menu.style.pointerEvents = 'none';
    }

    toggleDropdown(dropdown, menu) {
        if (dropdown.classList.contains('show')) {
            this.hideDropdown(dropdown, menu);
        } else {
            this.closeAllDropdowns();
            this.showDropdown(dropdown, menu);
        }
    }

    showMegaMenu(megaMenu, menu) {
        megaMenu.classList.add('show');
        menu.classList.add('show');
        menu.style.opacity = '1';
        menu.style.transform = 'translateY(0) scale(1)';
        menu.style.pointerEvents = 'all';

        // Animar itens do mega menu
        const items = menu.querySelectorAll('.dropdown-item');
        items.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }

    hideMegaMenu(megaMenu, menu) {
        megaMenu.classList.remove('show');
        menu.classList.remove('show');
        menu.style.opacity = '0';
        menu.style.transform = 'translateY(-10px) scale(0.95)';
        menu.style.pointerEvents = 'none';
    }

    closeAllDropdowns() {
        this.dropdowns.forEach(dropdown => {
            const menu = dropdown.querySelector('.dropdown-menu');
            this.hideDropdown(dropdown, menu);
        });

        this.megaMenus.forEach(megaMenu => {
            const menu = megaMenu.querySelector('.dropdown-menu');
            this.hideMegaMenu(megaMenu, menu);
        });
    }

    animateHamburgerIcon(isOpen) {
        const icon = this.navbarToggler.querySelector('.navbar-toggler-icon');
        if (isOpen) {
            icon.style.transform = 'rotate(90deg)';
        } else {
            icon.style.transform = 'rotate(0deg)';
        }
    }

    animateMenuItems() {
        const menuItems = document.querySelectorAll('#navbarMain .nav-item');
        menuItems.forEach((item, index) => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(-20px)';
            
            setTimeout(() => {
                item.style.transition = 'all 0.3s ease';
                item.style.opacity = '1';
                item.style.transform = 'translateX(0)';
            }, index * 100);
        });
    }

    toggleDropdownKeyboard(toggle) {
        const dropdown = toggle.closest('.dropdown');
        const menu = dropdown.querySelector('.dropdown-menu');
        this.toggleDropdown(dropdown, menu);
        
        if (dropdown.classList.contains('show')) {
            const firstItem = menu.querySelector('.dropdown-item');
            if (firstItem) {
                firstItem.focus();
            }
        }
    }

    navigateToNext(currentLink) {
        const allLinks = Array.from(document.querySelectorAll('.nav-link, .dropdown-item'));
        const currentIndex = allLinks.indexOf(currentLink);
        const nextLink = allLinks[currentIndex + 1];
        
        if (nextLink) {
            nextLink.focus();
        }
    }

    navigateToPrevious(currentLink) {
        const allLinks = Array.from(document.querySelectorAll('.nav-link, .dropdown-item'));
        const currentIndex = allLinks.indexOf(currentLink);
        const prevLink = allLinks[currentIndex - 1];
        
        if (prevLink) {
            prevLink.focus();
        }
    }

    // Método para destacar seção ativa baseada no scroll
    highlightActiveSection() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link[href^="#"]');
        
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop - this.navbar.offsetHeight - 50;
            const sectionHeight = section.offsetHeight;
            
            if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                currentSection = section.getAttribute('id');
            }
        });
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${currentSection}`) {
                link.classList.add('active');
            }
        });
    }

    // Método para adicionar loading state
    addLoadingState(link) {
        const navItem = link.closest('.nav-item');
        navItem.classList.add('loading');
        
        setTimeout(() => {
            navItem.classList.remove('loading');
        }, 2000);
    }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', () => {
    window.modernMenuManager = new ModernMenuManager();
    
    // Destacar seção ativa no scroll
    let scrollTimeout;
    window.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            window.modernMenuManager.highlightActiveSection();
        }, 100);
    }, { passive: true });
});

// Fechar dropdowns ao clicar fora
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown') && window.modernMenuManager) {
        window.modernMenuManager.closeAllDropdowns();
    }
});

// Reajustar menu no resize
window.addEventListener('resize', () => {
    if (window.modernMenuManager && window.innerWidth > 991) {
        window.modernMenuManager.closeAllDropdowns();
    }
});

// Adicionar efeitos de hover personalizados
document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.setProperty('--hover-scale', '1.05');
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.setProperty('--hover-scale', '1');
        });
    });
});

// Função para adicionar breadcrumb dinâmico
function updateBreadcrumb() {
    const breadcrumbContainer = document.querySelector('.navbar-breadcrumb');
    if (!breadcrumbContainer) return;
    
    const pathSegments = window.location.pathname.split('/').filter(segment => segment);
    const breadcrumbItems = pathSegments.map((segment, index) => {
        const isLast = index === pathSegments.length - 1;
        const path = '/' + pathSegments.slice(0, index + 1).join('/');
        const title = segment.charAt(0).toUpperCase() + segment.slice(1);
        
        return `
            <li class="breadcrumb-item ${isLast ? 'active' : ''}">
                ${isLast ? title : `<a href="${path}">${title}</a>`}
            </li>
        `;
    }).join('');
    
    breadcrumbContainer.innerHTML = `
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Início</a></li>
                ${breadcrumbItems}
            </ol>
        </div>
    `;
}

