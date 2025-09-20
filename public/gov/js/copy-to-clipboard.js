/**
 * Função para copiar texto para área de transferência
 * Uso: data-copy-to-clipboard="texto a ser copiado"
 */
(function() {
    // Função para copiar texto
    function copyText(text, button) {
        // Verifica se clipboard API está disponível em contexto seguro
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text)
                .then(() => showSuccess(button))
                .catch(() => fallbackCopyMethod(text, button));
        } else {
            // Fallback para navegadores sem suporte a Clipboard API
            fallbackCopyMethod(text, button);
        }
    }

    // Método alternativo de cópia
    function fallbackCopyMethod(text, button) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-9999px';
        textArea.style.top = '0';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            if (successful) showSuccess(button);
        } catch (err) {
            console.error('Erro ao copiar texto: ', err);
            showError(button);
        } finally {
            document.body.removeChild(textArea);
        }
    }

    // Mostrar feedback de sucesso
    function showSuccess(button) {
        if (!button) return;
        
        const originalHTML = button.innerHTML;
        const originalClass = button.className;
        
        button.innerHTML = '<i class="fas fa-check me-1"></i> Copiado!';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-success');
        
        // Mostra notificação toast
        showNotification('Link copiado para a área de transferência!', 'success');
        
        setTimeout(function() {
            button.innerHTML = originalHTML;
            button.className = originalClass;
        }, 2000);
    }

    // Mostrar feedback de erro
    function showError(button) {
        if (!button) return;
        
        const originalHTML = button.innerHTML;
        const originalClass = button.className;
        
        button.innerHTML = '<i class="fas fa-times me-1"></i> Erro!';
        button.classList.remove('btn-outline-secondary');
        button.classList.add('btn-danger');
        
        // Mostra notificação toast
        showNotification('Não foi possível copiar o link.', 'danger');
        
        setTimeout(function() {
            button.innerHTML = originalHTML;
            button.className = originalClass;
        }, 2000);
    }

    // Função para mostrar notificação toast
    function showNotification(message, type = 'success') {
        // Verifica se já existe um container de toast
        let toastContainer = document.querySelector('.toast-container');
        
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '1090';
            document.body.appendChild(toastContainer);
        }
        
        // Cria o elemento toast
        const toastEl = document.createElement('div');
        const toastId = 'toast-' + Date.now();
        toastEl.id = toastId;
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');
        
        // Conteúdo do toast
        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
        `;
        
        // Adiciona o toast ao container
        toastContainer.appendChild(toastEl);
        
        // Inicializa e mostra o toast usando Bootstrap
        if (window.bootstrap && window.bootstrap.Toast) {
            const toastInstance = new bootstrap.Toast(toastEl, {
                delay: 3000,
                animation: true
            });
            toastInstance.show();
            
            // Remove do DOM após ocultar
            toastEl.addEventListener('hidden.bs.toast', function() {
                toastEl.remove();
            });
        } else {
            // Fallback se Bootstrap não estiver disponível
            toastEl.style.display = 'block';
            toastEl.style.opacity = '1';
            toastEl.style.transition = 'opacity 0.3s ease-out';
            
            setTimeout(function() {
                toastEl.style.opacity = '0';
                setTimeout(function() {
                    toastEl.remove();
                }, 300);
            }, 3000);
        }
    }

    // Inicialização - attach aos botões existentes
    document.addEventListener('DOMContentLoaded', function() {
        // Método 1: Usando data attributes
        document.querySelectorAll('[data-copy-to-clipboard]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const textToCopy = this.getAttribute('data-copy-to-clipboard');
                copyText(textToCopy, this);
            });
        });

        // Método 2: Compatibilidade com código existente 
        window.copyToClipboard = function(e, text) {
            const button = e?.target?.closest('button') || e?.currentTarget;
            copyText(text, button);
        };
        
        // Expõe a função de notificação globalmente
        window.showNotification = showNotification;
    });
})();