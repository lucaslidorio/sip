<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$tenant->nome}}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

  
  <link id="link-cor" rel="stylesheet" href="{{asset('css')}}/{{$tenant->arquivo_cor_css}}">  
  <link rel="stylesheet" href="{{asset('css/style-legislativo.css')}}">
  <link rel="stylesheet" href="{{asset('css/nivo-lightbox.css')}}"> 
  <link rel="stylesheet" href="{{asset('css/lc_lightbox.min.css')}}"> 
  <link rel="stylesheet" href="{{ asset('dashboard/css/fullcalendar/main.css') }}">

  
</head>
<body class="bg-color-0">
  <div class="container-fluid   bg-color-1 bg-gradient  ps-5 pe-5 ">
    <div class=" justify-content-end d-none d-md-flex">
      <ul class="nav nav-pills fw-semibold font-14">
        <li class="nav-item ">
          <a href="#" id="diminuirFonte" class="nav-link link-texto pe-1 text-decoration-none "  title="Diminuir o tamanho da fonte" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Diminuir o tamanho da fonte">
            <i class="bi bi-subscript"></i>
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" id="resetarFonte" class="nav-link link-texto pe-2 ps-2 m-0" title="Fonte tamanho normal" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Fonte tamanho normal">
            <i class="bi bi-type"></i> 
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" id="aumentarFonte" class="nav-link link-texto ps-1 " title="Aumentar o tamanho da fonte" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Aumentar o tamanho da fonte" style="font-size: 18px">
            <i class="bi bi-superscript "></i>
          </a>
          </li>

        <li class="nav-item ">
          <a href="{{route('site.mapa')}}" class="nav-link  link-texto "  title="Mapa do Site" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Mapa do Site" >
          <i class="bi bi-diagram-3-fill"></i> 
            Mapa do Site
          </a>
        </li>
            
        <li class="nav-item ">
          <a href="{{route('site.acessibilidade')}}" class="nav-link link-texto" title="Acessibilidade" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Acessibilidade">
            <i class="bi bi-universal-access-circle"></i>
            Acessibilidade
          </a>
        </li>
        <li class="nav-item ">
          <a href="{{route('pagina',  'contato')}}" class="nav-link link-texto" title="Contato" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Contato">
            <i class="bi bi-envelope-fill"></i> 
            Contato
          </a>
        </li>
        <li class="nav-item ">
          <a href="#" id="contraste" class="nav-link link-texto" title="Contraste" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Contraste">
            <i class="bi bi-circle-half"></i> 
            Contraste
          </a>
        </li>
        <li class="nav-item ">
          <a href="https://www.gov.br/governodigital/pt-br/vlibras/" class="nav-link link-texto" title="VLibras" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="VLibras">
            <i class="bi bi-hand-thumbs-up-fill"></i>
            VLibras
          </a>
        </li>
        
      </ul>
    </div>
    <header class="d-flex flex-wrap justify-content-center py-2">
      <a href="/" class="">        
      <img class="d-none d-sm-block me-3 mb-3 " src="{{config('app.aws_url')."{$tenant->brasao}" }}" width="100"
      height="100" alt="">
    </a>
      <a href="/" class="d-flex align-items-center mt-0  mb-md-0 me-md-auto text-dark text-decoration-none ">
        <span class="fs-1 text-white mb-5">{{$tenant->nome}}</span>
      </a>
      <form class="col-12 col-lg-auto mb-3 mt-lg-4" action="{{ route('site.pesquisar') }}" method="get" role="pesquisar">
       @csrf
        <div class="input-group mb-3">
          <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar"
            aria-describedby="button-addon2" >
          <button class="btn btn-outline-light" type="submit" id="button-addon2" ><i class="bi bi-search"></i></button>
        </div>
      </form>
    </header>
  </div>
  <div class="d-flex justify-content-end bg-color-2 pe-5 mt-0 mb-0 ">

    <ul class="nav text-white fw-semibold font-14">
      @foreach ($menusSuperior as $item)  
      <li class="nav-item ">

        @if ($item->pagina_interna == 1 && $item->url == null)
        <a href="{{route('pagina', $item->slug)}}" class="nav-link link-texto " title="{{$item->nome}} " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$item->nome}} ">
          <i class="{{$item->icone}}"></i> 
         {{$item->nome}} 
        </a>
        @elseif($item->pagina_interna == 1 && $item->url != null)
        <a href="{{route($item->url)}}" class="nav-link link-texto " title="{{$item->nome}} " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$item->nome}} ">
          <i class="{{$item->icone}}"></i> 
          {{$item->nome}} 
        </a> 
       @else
      <a href="{{$item->url}}" class="nav-link link-texto " title="{{$item->nome}} " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{$item->nome}} ">
        <i class="{{$item->icone}}"></i> 
        {{$item->nome}}  
      </a> 
      @endif
      </li>  
      @endforeach    
    </ul>
  </div>
      {{-- VLibras --}}
      <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
    {{-- Menu --}}
  <div class="container-fluid ps-5 pe-5">
    <div class="row  mt-5">
      <div class="col-md-3 col-lg-3   ">
          <div class="flex-shrink-0  bg-white " style="width: auto;">        
          <ul class="list-unstyled ps-0">   
           @foreach ($menus as $menu)                                      
            <li class="mb-1 bg-color-0">
              <button class=" w-100 btn btn-toggle  d-inline-flex align-items-center  border-0 collapsed bg-color-1"  data-bs-toggle="collapse" data-bs-target="#{{$menu->slug}}" aria-expanded="false">
                {{$menu->nome}}
              </button> 
                 @if(count($menu->submenu) > 0 )
                 <div class="expand collapse show " id="{{$menu->slug}}">
                  <ul class="btn-toggle-nav  list-unstyled fw-normal pb-1  small ">
                    @foreach ($menu->submenu as $item)                   
                      @if ($item->pagina_interna == 1 && $item->url == null)
                        <li><a href="{{route('pagina', $item->slug)}}" class="link-dark bg-color-0 d-flex text-decoration-none border-bottom p-2 mb-0 ">{{$item->nome}}</a></li>
                      @elseif($item->pagina_interna == 1 && $item->url != null)
                       <li><a href="{{route($item->url)}}" class="link-dark bg-color-0 d-flex text-decoration-none border-bottom p-2 mb-0 ">{{$item->nome}}</a></li>
                      @else
                        <li><a href="{{$item->url}}" target="{{$item->target ? '__blank': ''}}" class="link-dark bg-color-0 d-flex text-decoration-none border-bottom p-2 mb-0 ">{{$item->nome}}</a></li>
                      @endif

                  @endforeach                   
                  </ul>
                </div>      
                 @endif                                
             </li>                                
             @endforeach
          </ul> 
          
          </ul>
        </div>      
      </div>

      {{-- Conteúdo --}}
      <div class="col-md-6 col-lg-7 ">
        
        @yield('content')   
        
      </div>

      {{-- Fim conteúdo --}}
      <div class="col-md-3 col-lg-2  m-0 pt-md-0 p-md-3 p-sm-5  ">    
        @foreach ($linksDireita as $link)
        <div class="row  pt-0 mb-2   banner  ">
            <a href="{{$link->url}} ">
              <img src="{{config('app.aws_url').$link->icone }}" class="img-fluid w-100 h-100" alt="{{$link->nome}}">
            </a>            
          </div>
        @endforeach        
           {{-- Links uteis --}}          
          <div class="flex-shrink-0  bg-white " style="width: auto;">        
            <ul class="list-unstyled ps-0">                                       
              <li class="mb-1">
                <button class=" w-100 btn btn-toggle  d-inline-flex align-items-center  border-0 collapsed bg-color-1"  data-bs-toggle="collapse" 
                data-bs-target="#links-uteis" aria-expanded="false">
                  <h5>Link Úteis</h5>
                </button> 
                @foreach ($linksUteis as $link)
                   <div class="expand collapse show" id="links-uteis">
                    <ul class="btn-toggle-nav  list-unstyled fw-normal pb-1 small bg-color-0">
                      <li class="">
                        <a target="{{$link->target ? '_blank' : ''}}"  href="{{$link->url}}" class="link-dark bg-color-0 d-flex text-decoration-none border-bottom ">{{$link->nome}}</a></li>                  
                    </ul>
                  </div>      
                  @endforeach                               
               </li>  
            </ul>
            </ul>
          </div>
        </div>  
      </p>      
      </div>
    </div>
  </div>
 
  {{--Rodapé --}}
    <div class="container-fluid ps-5 pe-5  bg-color-1">
      <footer class="py-5 text-white">
        <div class="row d-flex d-flex justify-content-center">
          <div class="col-6 col-md-4 mb-2">
            <h5>{{$tenant->nome}}</h5>
            <h6>{{$tenant->endereco}}, {{$tenant->numero}}, {{$tenant->bairro}}
              {{$tenant->cidade}}
            </h6>
            <h6 class="fs-6">Telefone: {{$tenant->telefone}}</h6>
            <h6 class="fs-6">E-mail: {{$tenant->email}}</h6>
            <h6 class="fs-6">Atendimento: {{$tenant->dia_atendimento}}</h6>
          </div>

          <div class="col-6 col-md-4 mb-3">
            <h5>Responsável para assegurar o cumprimento da Lei de Acesso à Informação</h5>       
                   
            <h6 class="fs-6">Nome: {{$tenant->nome_resp_transparencia}}</h6>
            <h6 class="fs-6">E-Mail: {{$tenant->email_resp_transparencia}}</h6>
            <h6 class="fs-6">Fone: {{$tenant->telefone_resp_transparencia}}</h6>

          </div>
        </div>
      </footer>
    </div>
    <div class="d-flex flex-column flex-sm-row justify-content-between bg-color-2 pe-5 ps-5 pt-1   border-top">
      <p class="text-center text-white font-14">Todos os direitos reservados &copy; {{ date("Y") }} - {{$tenant->nome}}.
        <span>desenvolvido por:</span>
        <a target="_blank"  class="text-white" href="{{$tenant->developmentSettings->site}}"> {{$tenant->developmentSettings->nome_empresa}}</a>
      </p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" target="__blank" href="{{$tenant->youtube}}"><i
              class="bi bi-youtube fs-4 text-danger"></i></a></li>
        <li class="ms-3"><a class="link-dark" target="__blank" href="{{$tenant->instagram}}"><i
              class="bi bi-instagram fs-4 text-danger"></i></li>
        <li class="ms-3"><a class="link-dark" target="__blank" href="{{$tenant->facebook}}"><i
              class="bi bi-facebook fs-4 text-white"></i></a></li>
      </ul>
    </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
  </script> 
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

  <script>
    //Vlibras
    new window.VLibras.Widget('https://vlibras.gov.br/app');

    function handleShowClass() {
      const btnsToggle = document.querySelectorAll(".btn-toggle");
      const elements = document.querySelectorAll(".expand");
      const screenWidth = window.innerWidth; // Verifica a largura atual da tela
      
      if (screenWidth < 768) { btnsToggle.forEach((element)=> element.setAttribute("aria-expanded", "false"));// Percorre cada
        // elemento e altera o valor do atributo aria-expanded para false
        elements.forEach((element) => element.classList.remove("show")); // Remove a classe show das divs que possuem a classe collapse
        } else {
        btnsToggle.forEach((element) => element.setAttribute("aria-expanded", "true"));
        elements.forEach((element) => element.classList.add("show"));
        }
      }
    // Executa a função handleShowClass quando a página é carregada
    window.addEventListener("load", handleShowClass);
    // Executa a função handleShowClass quando a janela é redimensionada
    window.addEventListener("resize", handleShowClass);

    // Inicia os tolltip
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    //Aplica o contraste
    const protocolo = window.location.protocol;  
    const url_host = window.location.host; 
    const url_completa = protocolo+url_host;
    const toggleButton = document.getElementById("contraste");
    const linkElement =  document.getElementById("link-cor");
    let currentCssFile = 'css/style-blue.css';   
  
    toggleButton.addEventListener("click", function() {
     console.log(currentCssFile);
    // Toggle the CSS file by changing the href attribute of the link element
    if (currentCssFile === "css/style-blue.css") {
      currentCssFile = "css/contraste.css";
      linkElement.setAttribute("href", "css/contraste.css");
    } else {
      currentCssFile = "css/style-blue.css";
      linkElement.setAttribute("href", "css/style-blue.css");
    }
  });


    // Altera o tamanho da fonte
    let currentSize = 100; // tamanho atual da fonte em porcentagem
    const defaultSize = 100; // tamanho padrão da fonte em porcentagem 
    const increaseButton = document.getElementById('aumentarFonte'); // seleciona o elemento do botão de aumento
    const decrementButton = document.getElementById('diminuirFonte');
    const resetButton = document.getElementById('resetarFonte'); // seleciona o 

    increaseButton.addEventListener('click', () => {
      currentSize += 10; // aumenta o tamanho da fonte em 10%
      document.body.style.fontSize = currentSize + '%'; // aplica o novo tamanho da fonte ao elemento `body`
    });
    decrementButton.addEventListener('click', () => {
      currentSize -= 10; // aumenta o tamanho da fonte em 10%
      document.body.style.fontSize = currentSize + '%'; // aplica o novo tamanho da fonte ao elemento `body`
    });
    resetButton.addEventListener('click', () => {
    currentSize = defaultSize; // redefine o tamanho da fonte para o valor padrão
    document.body.style.fontSize = currentSize + '%'; // aplica o novo tamanho da fonte ao elemento `body`
  });


  </script>
  <script src="{{asset('js/jquery-min.js')}}"></script>
  <script src="{{asset('js/nivo-lightbox.js')}}"></script>
  <script src="{{asset('js/alloy_finger.min.js')}}"></script>
  <script src="{{asset('js/lc_lightbox.lite.min.js')}}"></script>
  <script src="{{ asset('dashboard/js/fullcalendar/main.js') }}"></script>    
  <script src="{{ asset('dashboard/js/fullcalendar/pt-br.js') }}"></script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</body>

</html>