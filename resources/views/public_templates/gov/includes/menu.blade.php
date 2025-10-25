
<nav class="navbar navbar-expand-lg navbar-main" id="mainNavbar">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto">
                    @foreach($menus as $menu)
                    @if($menu->isMegaMenu())
                    {{-- Mega Menu --}}
                    <li class="nav-item dropdown mega-menu">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                        <div class="dropdown-menu mega-menu-content">
                            <div class="row">
                                @foreach($menu->categorias as $categoria)
                                <div class="col-md-4">
                                    <h6 style="color: {{ $categoria->cor_destaque }}" class="border-bottom border-light-subtle ">
                                        {!! $categoria->getIconeHtml() !!} {{ $categoria->nome }}
                                    </h6>
                                    @foreach($categoria->itensCategoria as $item)
                                    <a href="{{ $item->getUrlCompleta() }}" class="dropdown-item">
                                        {!! $item->getIconeHtml() !!} {{ $item->nome }}
                                    </a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
    
                    @elseif($menu->isDropdown())
                    {{-- Dropdown Tradicional --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($menu->children as $submenu)
                            <li><a class="dropdown-item" href="{{ $submenu->getUrlCompleta() }}">
                                    {!! $submenu->getIconeHtml() !!} {{ $submenu->nome }}
                                </a></li>
                            @endforeach
                        </ul>
                    </li>
    
                    @else
                    {{-- Menu Simples --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $menu->getUrlCompleta() }}">
                            {!! $menu->getIconeHtml() !!} {{ $menu->nome }}
                        </a>
                    </li>
                    @endif
                    @endforeach                          
                    

                </ul>
                
                <!-- Botões de ação no menu -->
                {{-- <div class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#contatoModal">
                            <i class="fas fa-envelope"></i>
                            <span>Contato</span>
                        </a>
                    </li>
                </div> --}}
            </div>
        </div>
    </nav>