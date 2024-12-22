// start libras
new window.VLibras.Widget('https://vlibras.gov.br/app');
// end libras

// Efeito transição de image destaque
$(document).ready(function () {
    $('.slide-destaque').slick({
        speed: 1200,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnFocus: true,
        pauseOnHover: true,
        arrows: false,
        asNavFor: '.highlights-texts',
    });
    $('.highlights-texts').slick({
        speed: 1200,
        autoplay: true,
        slidesToScroll: 1,
        asNavFor: '.slide-destaque',
        pauseOnFocus: true,
        pauseOnHover: true,
        pauseOnDotsHover: true,
        dots: true,
        appendDots: '.highlights-dots',
        dotsClass: 'list-inline pull-right'
    });
});


// Efeito transição de image Vereadores
$(document).ready(function () {
    $('.slide-vereadores').slick({
        speed: 1200,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnFocus: true,
        pauseOnHover: true,
        arrows: false,
        asNavFor: '.highlights2-texts',
    });
    $('.highlights2-texts').slick({
        speed: 1200,
        autoplay: true,
        slidesToScroll: 1,
        asNavFor: '.slide-vereadores',
        pauseOnFocus: true,
        pauseOnHover: true,
        pauseOnDotsHover: true,
        dots: true,
        appendDots: '.highlights2-dots',
        dotsClass: 'list-inline pull-right'
    });
});




// dark 
let modoEscuroAtivo = false;
const estilosOriginais = new Map();

function salvarEstilosOriginais() {
    const todosElementos = document.querySelectorAll('*');
    todosElementos.forEach(elemento => {
        const estilos = {
            backgroundColor: elemento.style.backgroundColor || '',
            color: elemento.style.color || ''
        };
        estilosOriginais.set(elemento, estilos);
    });
}

function aplicarModoEscuro() {
    const todosElementos = document.querySelectorAll('*');
    todosElementos.forEach(elemento => elemento.classList.add('dark-mode'));

    const todasImagens = document.querySelectorAll('img');
    todasImagens.forEach(imagem => imagem.classList.add('dark-mode-img'));
}

function restaurarEstilosOriginais() {
    estilosOriginais.forEach((estilos, elemento) => {
        elemento.style.backgroundColor = estilos.backgroundColor;
        elemento.style.color = estilos.color;
        elemento.classList.remove('dark-mode');
    });

    const todasImagens = document.querySelectorAll('img');
    todasImagens.forEach(imagem => imagem.classList.remove('dark-mode-img'));
}

function toggleDarkMode() {
    if (!modoEscuroAtivo) {
        if (estilosOriginais.size === 0) {
            salvarEstilosOriginais();
        }

        aplicarModoEscuro();

    } else {
        restaurarEstilosOriginais();
    }

    modoEscuroAtivo = !modoEscuroAtivo;
}

function restaurarTamanhoNormal() {
    const todosElementos = document.querySelectorAll('*');
    todosElementos.forEach(elemento => {
        elemento.style.fontSize = '10px';
    });
}

function diminuirFonte() {
    const todosElementos = document.querySelectorAll('*');
    todosElementos.forEach(elemento => {
        const tamanhoAtual = window.getComputedStyle(elemento).fontSize;
        const novoTamanho = parseFloat(tamanhoAtual) * 0.99;
        elemento.style.fontSize = `${novoTamanho}px`;
    });
}

function aumentarFonte() {
    const todosElementos = document.querySelectorAll('*');
    todosElementos.forEach(elemento => {
        const tamanhoAtual = window.getComputedStyle(elemento).fontSize;
        const novoTamanho = parseFloat(tamanhoAtual) * 1.01;
        elemento.style.fontSize = `${novoTamanho}px`;
    });
}


const maxLength = 200; // Número máximo de caracteres
const paragraphs = document.querySelectorAll('[id^="limiteLinha["]'); // Seleciona IDs que começam com "linha["

paragraphs.forEach(paragraph => {
    if (paragraph.innerText.length > maxLength) {
        paragraph.innerText = paragraph.innerText.substring(0, maxLength) + "...";
    }
});