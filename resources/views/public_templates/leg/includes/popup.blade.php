{{-- /resources/views/caminho/para/seu/popup-blade.blade.php --}}

@php
    $popupsParaMostrar = collect($popups)->filter(function ($popup) {
        return !isset($_COOKIE['popup_' . $popup->id]);
    });
@endphp

@if($popupsParaMostrar->isNotEmpty())

    {{-- Divs de dados (não precisam mudar) --}}
    @foreach($popupsParaMostrar as $popup)
        <div class="popup-data"
             style="display: none;"
             data-popup-id="{{ $popup->id }}"
             data-popup-img="{{ config('app.aws_url') . $popup->img }}"
             data-popup-url="{{ $popup->url }}">
        </div>
    @endforeach

    {{-- ==================== CSS ATUALIZADO PARA O VISUAL MODERNO ==================== --}}
    <style>
        /* Torna o container do popup totalmente transparente e sem bordas */
        .popup-imagem-moderno {
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Esconde o título padrão do SweetAlert2, caso ele apareça */
        .popup-imagem-moderno .swal2-title {
            display: none !important;
        }

        /* Container que envolve a imagem para permitir posicionamento relativo dos botões */
        .wrapper-imagem-popup {
            position: relative;
            line-height: 0; /* Remove espaço extra abaixo da imagem */
        }

        /* A imagem principal do popup */
        .imagem-principal-popup {
            max-width: 80vw;  /* Garante que a imagem não ultrapasse 80% da largura da tela */
            max-height: 80vh; /* Garante que a imagem não ultrapasse 80% da altura da tela */
            border-radius: 8px; /* Bordas arredondadas na imagem */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); /* Sombra na própria imagem */
        }
        
        /* Botão customizado "Não mostrar novamente" */
        .nao-mostrar-novamente-btn {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-family: sans-serif;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            backdrop-filter: blur(3px);
        }
        .nao-mostrar-novamente-btn:hover {
            background-color: rgba(0, 0, 0, 0.9);
            transform: translateX(-50%) scale(1.05);
        }
        
        /* Botão de fechar (X) reposicionado e reestilizado */
        .botao-fechar-moderno {
            position: absolute !important;
            top: -15px !important;
            right: -15px !important;
            width: 35px !important;
            height: 35px !important;
            font-size: 2em !important;
            font-weight: bold;
            color: white !important;
            background: rgba(0, 0, 0, 0.5) !important;
            border: 2px solid white;
            border-radius: 50% !important;
            transition: all 0.2s ease-in-out;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .botao-fechar-moderno:hover {
            background: #d32f2f !important; /* Vermelho no hover */
            transform: rotate(90deg) scale(1.1);
        }
    </style>

    {{-- ==================== SCRIPT ATUALIZADO ==================== --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const popupsParaMostrar = Array.from(document.querySelectorAll(".popup-data")).filter(el => {
            const id = el.dataset.popupId;
            const cookieName = "popup_" + id;
            return !getCookie(cookieName);
        });

        function exibirPopupDaFila(indice) {
            if (indice >= popupsParaMostrar.length) {
                return;
            }

            const popupElement = popupsParaMostrar[indice];
            const { popupId, popupImg, popupUrl } = popupElement.dataset;
            const cookieName = "popup_" + popupId;

            // NOVO: Monta o HTML com o wrapper para a imagem e o botão customizado
            const htmlContent = `
                <div class="wrapper-imagem-popup">
                    <a href="${popupUrl || '#'}" ${popupUrl ? 'target="_blank"' : ''}>
                        <img src="${popupImg}" class="imagem-principal-popup" alt="Popup">
                    </a>
                    <div id="naoMostrarBtn-${popupId}" class="nao-mostrar-novamente-btn">
                        Não mostrar novamente
                    </div>
                </div>
            `;

            Swal.fire({
                html: htmlContent,
                showConfirmButton: false,
                showCloseButton: true,
                // Configurações para o visual limpo
                width: 'auto',
                padding: 0,
                background: 'transparent',
                backdrop: `rgba(0, 0, 0, 0.7)`, // Fundo escuro da página
                
                customClass: {
                    popup: 'popup-imagem-moderno', // Classe principal para o container
                    closeButton: 'botao-fechar-moderno' // Classe para o botão (X)
                },

                didOpen: () => {
                    // Adiciona o evento de clique ao nosso novo botão
                    const naoMostrarBtn = document.getElementById(`naoMostrarBtn-${popupId}`);
                    naoMostrarBtn.addEventListener('click', (event) => {
                        event.stopPropagation(); // Impede que o clique no botão propague para o link da imagem
                        setCookie(cookieName, "1", 12);
                        Swal.close();
                    });
                }
            }).then(() => {
                exibirPopupDaFila(indice + 1);
            });
        }

        if (popupsParaMostrar.length > 0) {
            exibirPopupDaFila(0);
        }

        function setCookie(name, value, hours) {
            const d = new Date();
            d.setTime(d.getTime() + (hours * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = name + "=" + value + ";" + expires + ";path=/";
        }

        function getCookie(name) {
            // ... (função getCookie permanece a mesma)
            const cookieName = name + "=";
            const decodedCookie = decodeURIComponent(document.cookie);
            const ca = decodedCookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(cookieName) === 0) {
                    return c.substring(cookieName.length, c.length);
                }
            }
            return null;
        }
    });
    </script>
@endif