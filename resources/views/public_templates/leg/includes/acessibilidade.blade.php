@extends('public_templates.leg.default')

@section('content')
<div class="row" style="height: 60px; background-color: #f5f5f5">
    <div class="container ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">Acessibilidade</p>
            </div>
            <div class="col-4 fs-4">{{Breadcrumbs::render('acessibilidade')}}</div>
        </div>
    </div>
  </div>
<div class="container">
  
 

  <div id="content-core " class="fs-3">
      <p>Este site foi projetado para ser completamente acessível e usável, estando em conformidade com as Diretrizes de Acessibilidade para 
         Conteúdo Web (<acronym title="Diretrizes de Acessibilidade para Conteúdo Web">WCAG</acronym> v1.0).
         Se existir qualquer problema — relacionado à acessibilidade ou validação — que não esteja de acordo com os padrões, por favor entre
         em contato com a <a href="{{route('pagina', 'contato')}}">Administração do Site</a>
      </p>

      <h4 class="font-blue">Tamanho do texto</h4> <noscript>(Requer JavaScript)</noscript>

      {{-- <ul>
          <li><a href="#" id="aumentarFonteAces" title="Texto Grande">Grande</a></li>
          <li><a href="javascript:setBaseFontSize('',1);" title="Texto Normal">Normal</a></li>
          <li><a href="#" id=" diminuirFonteAces" title="Texto Pequeno">Pequeno</a></li>
      </ul> --}}
       <p>Também é possível utilizar as seguintes combinações de teclas para usar o zoom no Microsoft Windows ou no Linux:</p>
      <ul>
          <li>Combinação da tecla CTRL e a tecla + (mais) para aumentar</li>
          <li>Combinação da tecla CTRL e a tecla - (menos) para diminuir</li>
          <li>Combinação da tecla CTRL e a tecla 0 (zero) para restaurar o tamanho original</li>
      </ul>
      <p>E no Mac OS:</p>
      <ul>
          <li>Combinação da tecla COMMAND e a tecla + (mais) para aumentar</li>
          <li>Combinação da tecla COMMAND e a tecla - (menos) para diminuir </li>
          <li>Combinação da tecla COMMAND e a tecla 0 (zero) para restaurar o tamanho original</li>
      </ul>
      {{--
      <h2>Teclas de acesso</h2>

      <p>Teclas de acesso são um recurso de navegação que permitem você navegar neste site com o seu teclado, elas dependem do sistema
         operacional e do navegador que você usa. As combinações possíveis são:</p>
      <ul>
          <li>tecla ALT para os navegadores Internet Explorer, Google Chrome e Safari em um computador Microsoft Windows</li>
          <li>teclas SHIFT e ALT, simultaneamente, para o navegador Mozilla Firefox em um computador Microsoft Windows ou Linux</li>
          <li>tecla COMMAND para o sistema operacional Mac OS</li>
      </ul>

      <p>Para acessar os itens abaixo, mantenha as teclas pressionadas mais o número abaixo escolhido:</p>

      <ul>
          <li><code>1</code> — Página Inicial</li>
          <li><code>2</code> — Ir para o conteúdo</li>
          <li><code>3</code> — Mapa do Site</li>
          <li><code>4</code> — Foco no campo de busca</li>
          <li><code>5</code> — Busca Avançada</li>
          <li><code>6</code> — Navegação</li>
          <li><code>9</code> — Informações de contato</li>
          <li><code>0</code> — Detalhes das Teclas de Atalho</li>
      </ul> --}}
      <h2>Tradução automática de conteúdos de Língua Portuguesa para a Libras</h2>
      <p>O <a href="http://www.vlibras.gov.br/">VLibras</a> é uma suíte de ferramentas utilizadas na tradução automática do Português para a Língua Brasileira de Sinais. É possível utilizar essas ferramentas tanto no computador Desktop quanto em smartphones e tablets, através de extensões instaladas nos navegadores <a href="https://chrome.google.com/webstore/search/VLibras?hl=pt-BR" title="Link extensão Google Chrome">Google Chrome</a>, <a href="http://vlibras.gov.br/vlibras-plugin4.xpi" title="Link extensão Firefox">Firefox</a>, <a href="http://vlibras.gov.br/vlibras-plugin4.safariextz" title="Link extensão Safari">Safari</a>; instalação nos sistemas operacionais <a href="http://vlibras.gov.br/vlibras_instalador_5.1.0.exe" title="Instalador para Windows">Windows (7 ou superior)</a>, <a href="http://vlibras.gov.br/vlibras-1.0.0-170220.1540.nvda-addon" title="Instalador Addon VLibras NVDA">Addon VLibras NVDA</a>, <a href="http://vlibras.gov.br/vlibras-desktop_5.1.0_i386.deb" title="Instalador 32 bits Debian">Linux (32 bits)</a>, <a href="http://vlibras.gov.br/vlibras-desktop_5.1.0_amd64.deb" title="Instalador 64 bits Debian">Linux (64 bits)</a>; instalação em <a href="https://play.google.com/store/apps/details?id=com.lavid.vlibrasdroid" title="Aplicativo para Android">Android e </a><a href="https://itunes.apple.com/br/app/vlibras/id1039641615?mt=8" title="Aplicativo para IOS">IOS</a>.</p>
  </div>
</div>
</div>


@endsection