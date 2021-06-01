

    <div class="navbar-area w-100 bg-white fixed-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg mainmenu-area">
             
              @foreach($tenants as $tenant)
                {{-- <a class="navbar-brand" href="{{route('site.home')}}">
                  <img src="{{url("storage/{$tenant->brasao}")}}" class="rounded img-fluid float-left" alt="Brasão"
                  style="max-width: 50px;">  </a>             --}}
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
                    <a class="nav-link page-scroll" href="{{route('site.home')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#legislacao'}}">Legislação</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll text-nowrap" href="{{route('site.home').'#sobre'}}">A Câmara</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#features">Features</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#pricing">Pricing</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#vereadores'}}">Vereadores</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#blog'}}">Notícias</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#contato'}}">Contato</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="#subscribe">Subscribe</a>
                  </li>
                  <li class="nav-item d-none d-lg-inline-block">
                    <button class="menu-button" id="open-button"><i class="lnr lnr-menu"></i></button>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="menu-wrap">
      <nav class="menu">
        <div class="icon-list navbar-collapse">
          <div class="about-info">
            <h3 class="sidebar-title">About</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. sequi ducimus. Voluptate ab esse
              maiores corporis.</p>
          </div>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#blog">Blog</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#contact">Purchase Now</a>
            </li>
            <li class="nav-item">
              <a class="nav-link page-scroll" href="#subscribe">Support</a>
            </li>
          </ul>
        </div>
      </nav>
      <button class="close-button" id="close-button"><i class="lnr lnr-cross"></i></button>
    </div>
