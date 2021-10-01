    {{-- Link css de icones --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="navbar-area w-100 bg-white fixed-top ">
      <div class="container">
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
                    <a class="nav-link page-scroll" href="{{route('site.home')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#legislacao'}}">Legislação</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll" href="{{route('site.home').'#features'}}">Institucional</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link page-scroll text-nowrap" href="{{route('site.home').'#sobre'}}">A Câmara</a>
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
               
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
