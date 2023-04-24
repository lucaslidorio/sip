<div class="header-bottom  header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-xl-2 col-lg-2">
                <div class="logo">
                    {{-- <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a> --}}
                    {{-- <a href="index.html"><img src="{{asset('img/logo/logo.png')}}" alt=""></a> --}}
                    <a href="{{route('site.home')}}"><img src="{{config('app.aws_url')."{$tenant->brasao}" }}" alt=""></a>
                    
                </div>
            </div>
            <div class="col-xl-10 col-lg-10">
                <!-- Main-menu -->
                <div class="main-menu f-right d-none d-lg-block">
                    <nav> 
                        <ul id="navigation">                             
                         @foreach ($menus as $menu)                            
                           <li><a href="{{$menu->url}}">{{$menu->nome}}</a>                     
                                
                                @if(count($menu->submenu) > 0 )
                                    <ul class="submenu">
                                        @foreach ($menu->submenu as $item)
                                            <li><a href="{{config('app.url')."{$item->url}"}}">{{$item->nome}}</a></li>
                                        @endforeach    
                                    </ul>      
                                @endif                                
                            </li>                                
                            @endforeach
                            
                            {{-- <li><a href="index.html">Home</a></li>
                            <li><a href="services.html">Services</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="project.html">Projects</a></li>
                            <li><a href="blog.html">Blog</a>
                                <ul class="submenu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="blog_details.html">Blog Details</a></li>
                                    <li><a href="elements.html">Elements</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li> --}}
                            <li>
                                <div class="nav-search search-switch">
                                    <i class="fas fa-search"></i>
                                </div>
                            </li>
                            <li>
                                <div class="header-right-btn f-right  ml-15">
                                    <a href="http://transparencia.novohorizonte.ro.gov.br:5659/transparencia/" target="_blank" class="header-btn">Transparência</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> 
            <!-- Mobile Menu -->
            <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
            </div>
        </div>
    </div>
</div>
