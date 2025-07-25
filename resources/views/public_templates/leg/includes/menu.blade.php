<div class="header-top-menu">
    <nav class="navbar yamm navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="collapsed navbar-toggle" data-bs-toggle="collapse"
                    data-bs-target="#menu-topo-site" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <nav class="navbar navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="menu-topo-site">
                    <aside>
                        <ul class="nav navbar-nav menu-hover">
    
                            @foreach($menus as $menu)
                            <li class="dropdown">
                                @if($menu->hasChildren())
                                    <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle dropdown-toggle-arrow"
                                       aria-expanded="true" id="navbarDropdownMenuLink{{ $menu->id }}">
                                        @if($menu->icone)
                                            <i class="{{ $menu->icone }}"></i>
                                        @endif
                                        {{ $menu->nome }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink{{ $menu->id }}">
                                        <div class="yamm-content rg-yamm-simple">
                                            <div class="row">
                                                <ul class="lista1 lista-menu">
                                                    @foreach($menu->children as $submenu)
                                                        <li>
                                                            @if($submenu->pagina_interna == 1 && $submenu->url == null)
                                                                <a href="{{ route('pagina', $submenu->slug) }}"
                                                                   class="dropdown-item"
                                                                   title="{{ $submenu->nome }}"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   data-bs-title="{{ $submenu->nome }}">
                                                                    @if($submenu->icone)
                                                                        <i class="{{ $submenu->icone }}"></i>
                                                                    @endif
                                                                    {{ $submenu->nome }}
                                                                </a>
                                                            @elseif($submenu->pagina_interna == 1 && $submenu->url != null)
                                                                <a href="{{ route($submenu->url) }}"
                                                                   class="dropdown-item"
                                                                   title="{{ $submenu->nome }}"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   data-bs-title="{{ $submenu->nome }}">
                                                                    @if($submenu->icone)
                                                                        <i class="{{ $submenu->icone }}"></i>
                                                                    @endif
                                                                    {{ $submenu->nome }}
                                                                </a>
                                                            @else
                                                                <a href="{{ $submenu->url }}"
                                                                   class="dropdown-item"
                                                                   target="{{ $submenu->target ? '_blank' : '_self' }}"
                                                                   title="{{ $submenu->nome }}"
                                                                   data-bs-toggle="tooltip"
                                                                   data-bs-placement="top"
                                                                   data-bs-title="{{ $submenu->nome }}">
                                                                    @if($submenu->icone)
                                                                        <i class="{{ $submenu->icone }}"></i>
                                                                    @endif
                                                                    {{ $submenu->nome }}
                                                                </a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </ul>
                                @else
                                    @if($menu->pagina_interna == 1 && $menu->url == null)
                                        <a href="{{ route('pagina', $menu->slug) }}"
                                           target="{{ $menu->target ? '_blank' : '_self' }}">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                    @elseif($menu->pagina_interna == 1 && $menu->url != null)
                                        <a href="{{ route($menu->url) }}"
                                           target="{{ $menu->target ? '_blank' : '_self' }}">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                    @else
                                        <a href="{{ $menu->url }}"
                                           target="{{ $menu->target ? '_blank' : '_self' }}">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                        
                            {{-- @foreach($menus as $menu)
                                <li class="dropdown">
                                    @if($menu->hasChildren())
                                        <a href="#" data-bs-toggle="dropdown" class="dropdown-toggle dropdown-toggle-arrow"
                                           aria-expanded="true" id="navbarDropdownMenuLink{{ $menu->id }}">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                        <ul class="dropdown-menu"  aria-labelledby="navbarDropdownMenuLink{{ $menu->id }}">
                                           
                                                <div class="yamm-content rg-yamm-simple">
                                                    <div class="row">
                                                        <ul class="lista1 lista-menu">
                                                           @foreach($menu->children as $submenu)
                                                            <li>
                                                                  <a href="{{$submenu->url }}" class="dropdown-item" target="{{ $submenu->target ? '_blank' : '_self' }}">
                                                                    @if($submenu->icone)
                                                                        <i class="{{ $submenu->icone }}"></i>
                                                                    @endif
                                                                    {{ $submenu->nome }}
                                                                  </a>
                                                                </li>
                                                              @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                          
                                        </ul>
                                    @else
                                        <a href="{{$menu->url}}" target="{{ $menu->target ? '_blank' : '_self' }}">
                                            @if($menu->icone)
                                                <i class="{{ $menu->icone }}"></i>
                                            @endif
                                            {{ $menu->nome }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach --}}
                        </ul>
                    </aside>
                </div>
            </nav>
        </div>
    </nav>
</div>