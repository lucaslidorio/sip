

    <div  id="menu"  class="navbar-area w-100 bg-white fixed-top  ">
      <div class="container " id="menu-c" >
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg mainmenu-area">
             
              @foreach($tenants as $tenant)
                <a class="navbar-brand d-none d-md-block" href="{{route('site.home')}}">
                  <img src="{{config('app.aws_url')."{$tenant->brasao}" }}" class="rounded img-fluid float-left" alt="Brasão"
                  style="max-width: 50px;">  </a>            
              <a class="navbar-brand" href="{{route('site.home')}}">  {{$tenant->nome}}</a>
              @endforeach
    
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                    <a class="nav-link page-scroll" href="#slider-area">Início</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#services">Legislação</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#features">Institucional</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll text-nowrap" href="#portfolios">A Câmara</a>
                  </li>                
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#vereadores">Vereadores</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#contact">Notícias</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link page-scroll" href="#contato">Contato</a>
                  </li> --}}
                 
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>