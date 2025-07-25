<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '  ',
    'title_prefix' => 'SIP | ',
    'title_postfix' => 'Sistema Integrado de Publicações',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => 'Publicações',
    'logo_img' => 'vendor/adminlte/dist/img/logo.png',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SIP',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 75,
            'height' => 75,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/preload.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,
  

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => false,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'text' => 'Posts',
            'url'  => 'admin/posts',
            'icon' => 'far fa-clipboard',
            'can' => 'ver-post',
        ],
        [
            'text' => 'Popups',
            'url'  => 'admin/popups',
            'icon' => 'fas fa-fire',
            'can' => 'ver-post',
        ],
        [
            'text' => 'Leis',
            'url'  => 'admin/legislations',
            'icon' => 'fas fa-balance-scale',
            'can' => 'ver-legislacao',
        ],
        [
            'text' => 'Carta ao Cidadão',
            'url'  => 'admin/citizenLetters',
            'icon' => 'far fa-envelope',
            'can' => 'ver-carta-cidadao',
          
        ],   
        

        [
            'text'   => 'Ouvidoria',
            'icon'   => 'fas fa-phone-square-alt', 
            'active' => ['admin/ouvidoria/*'] ,
            'can'    =>   'ver-ouvidoria',                        
            'submenu' => [
                [
                    'text' => 'Configuração',
                    'url'  => 'admin/configuracao/ouvidoria',
                    'active' => ['admin/configuracao/ouvidorias/*' ],
                    'icon' => 'fas fa-sliders-h',
                    'can' => 'ver-ouvidoria',
                ], 
                [
                    'text' => 'Ouvidoria',
                    'url'  => 'admin/ouvidorias',
                    'active' => ['admin/ouvidorias/*' ],
                    'icon' => 'fas fa-phone-alt',
                    'can' => 'ver-ouvidoria',
                ], 
                              
           ],
        ],

        
        [
            'text' => ' Agenda',
            'url'  => 'admin/agenda',
            'icon' => 'far fa-calendar-alt',
            'can'  => 'ver-agenda',
        ],

        [
            'text' => ' Enquetes',
            'url'  => 'admin/enquetes',
            'icon' => 'fas fa-tasks',
            'can'  => 'ver-enquete',
        ],
        [
            'text' => 'Pesquisas',
            'url'  => 'admin/pesquisas',
            'icon' => 'far fa-grin-stars',
            'can'  => 'ver-pesquisa',
        ],
        [
            'text'    => 'Diário Oficial',
            'icon'    => 'fas fa-book', 
            'active' => ['admin/diario/*'] ,
            'can'    =>   'ver-diario-oficial',                        
            'submenu' => [
                [
                    'text' => 'Tipos de Matéria',
                    'url'  => 'admin/diario/tipoMaterias',
                    'active' => ['admin/diario/tipoMaterias*' ],
                    'icon' => 'fas  fa-text-width',
                    'can' => 'ver-tipo-materia',
                ], 
                [
                    'text' => 'Sub Tipo de Matérias',
                    'url'  => 'admin/diario/subTipoMateria',
                    'active' => ['admin/diario/subTipoMateria*' ],
                    'icon' => 'fas fa-text-width',
                    'can' => 'ver-tipo-materia',
                ],
                [
                    'text' => 'Documentos',
                    'url'  => 'admin/diario/documentos',
                    'active' => ['admin/diario/documentos*' ],
                    'icon' => 'fas fa-file-word',
                    'can' => 'ver-documento-dof',
                ],                 
           ],
        ],
        
        
        ['header' => 'LEGISLATIVO',
        'can'    =>   'legislativo',],
        [
            'text' => 'Sessões',
            'url'  => 'admin/legislativo/sessions',
            'icon' => 'fas fa-handshake',
            'can' => 'ver-sessao',
        ],
        [
            'text' => 'Proposituras',
            'url'  => 'admin/propositions',
            'icon' => 'fas fa-file-invoice',
            'can' => 'ver-propositura',
        ],
        [
            'text' => 'Pronunciamentos',
            'url'  => 'admin/pronunciamentos',
            'icon' => 'fas fa-microphone-alt',
            'can' => 'ver-pronunciamento',
        ],

      
        [
            'text' => 'Vereadores',
            'url'  => 'admin/legislativo/councilors',
            'icon' => 'fas fa-user-tie',
            'can' => 'ver-vereador',
        ],
      
        [
            'text' => 'Legislaturas',
            'url'  => 'admin/legislativo/legislatures',
            'icon' => 'fas fa-university',
            'can' => 'ver-legislatura',
        ],
        [
            'text' => 'Comissões',
            'url'  => 'admin/commissions',
            'icon' => 'fas fa-user-tag',
            'can' => 'ver-comissao',
        ],
        [
            'text' => 'Pareceres',
            'url'  => 'admin/seemCommissions',
            'icon' => 'fab fa-searchengin',
            'can' => 'ver-parecer',
        ],
        [
            'text' => 'Mesa Diretora',
            'url'  => 'admin/directorTables',
            'icon' => 'fas fa-tablets',
            'can'  => 'ver-mesa-diretora',
        ],        

      
        ['header' => 'ADMINISTRAÇÃO',
        'can'    =>   'administrativo',],
        [
            'text' => 'Orgão',
            'url'  => 'admin/tenants',
            'icon' => 'fas fa-university',
            'can'  => 'ver-orgao',
            
        ],
        [
            'text' => 'Secretarias',
            'url'  => 'admin/secretaries',
            'icon' => 'fas fa-table',
            'can'  => 'ver-secretaria',
        ],
        [
            'text' => 'Setores',
            'url'  => 'admin/setores',
            'icon' => 'fas fa-building',
            'can'  => 'ver-setor',
        ],
        [
            'text' => 'Categorias',
            'url'  => 'admin/categorias',
            'icon' => 'fas fa-list',
            'can'  => 'ver-categoria',
        ],
        [
            'text' => 'Partidos',
            'url'  => 'admin/parties',
            'icon' => 'fas fa-ad',
            'can'  => 'ver-partido',
            
        ],
        [
            'text' => 'Funções',
            'url'  => 'admin/functions',
            'icon' => 'fas fa-plus-square',
            'can'  => 'ver-funcoes',
        ],
       
        ['header' => 'COMPRAS',
        'can'    =>   'compras',],
        [
            'text' => 'Processos',
            'url'  => 'admin/processos',
            'icon' => 'fas fa-folder',
            'can'  => ['ver-processos-usuario-externo','ver-processo-compras'],            
        ],
        [
            'text' => 'Fornecedores',
            'url'  => 'admin/fornecedores',
            'icon' => 'fas fa-folder',
            'can'  => ['ver-fornecedor'],            
        ],

        ['header' => 'CONFIGURAÇÕES',
        'can'    =>   'admin',],
        [
            'text'    => 'Layout',
            'icon'    => 'fas fa-layer-group', 
            'active' => ['admin/layout*'] ,
            'can'    =>   'admin',                        
            'submenu' => [
                [
                    'text' => 'Menu',
                    'url'  => 'admin/layout/menus',
                    'active' => ['admin/menus*' ],
                    'icon' => 'fas fa-bars',
                    'can' => 'admin',
                ],  
                [
                    'text' => 'Links',
                    'url'  => 'admin/layout/links',
                    'active' => ['admin/links*' ],
                    'icon' => 'fas fa-link',
                    'can' => 'admin',
                ],  
                [
                    'text' => 'Páginas',
                    'url'  => 'admin/layout/pages',
                    'active' => ['admin/pages*' ],
                    'icon' => 'far fa-file-word',
                    'can' => 'admin',
                ],                      
               
            ],
        ],
        
        [
            'text'    => 'Segurança',
            'icon'    => 'fas fa-lock', 
            'active' => ['admin/users*','admin/profiles*','admin/permissions*'] ,
            'can'    =>   'admin',                        
            'submenu' => [
                [
                    'text' => 'Usuários',
                    'url'  => 'admin/users',
                    'active' => ['admin/users*' ],
                    'icon' => 'fas fa-users',
                    'can' => 'admin',
                ],
                [
                    'text' => 'Planos',
                    'url'  => 'admin/plans',
                    'active' => ['admin/plans*'],
                    'icon' => 'far fa-address-card', 
                                    
                ],
                [
                    'text' => 'Perfis',
                    'url'  => 'admin/profiles',
                    'active' => ['admin/profiles*'],
                    'icon' => 'fas fa-id-badge',                    
                ],
                [
                    'text' => 'Permissões',
                    'url'  => 'admin/permissions',
                    'active' => ['admin/permissions*'],
                    'icon' => 'fas fa-key',
                ],               
               
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,  
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',               
                    
                ],

                [
                    'type' => 'css',
                    'asset' => false,                   
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
                [
                    'type' => 'css',
                    'asset' => false,                   
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css',
                ],
               
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
                'icheck-bootstrap' => [
                    'active' => true,
                    'files' => [
                        [
                            'type' => 'css',
                            'asset' => false,
                            'location' => '//cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css',
                        ],
                        
                    ],
                ],
                'inputmask' => [
                    'active' => true,
                    'files' => [              
                        [
                            'type' => 'js',
                            'asset' => true,
                            'location' => 'vendor/inputmask/jquery.inputmask.min.js',
                        ],
                    ],
                ], 

                'Dropzone' => [
                    'active' => true,
                    'files' => [
                        [
                            'type' => 'js',
                            'asset' => true,
                            'location' => 'https://unpkg.com/dropzone@5/dist/min/dropzone.min.js',
                        ],
                        [
                            'type' => 'css',
                            'asset' => false,
                            'location' => 'https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css',
                        ],
                    ],
                ],


                'Summernote' => [
                    'active' => false,
                    'files' => [
                        [
                            'type' => 'css',
                            'asset' => false,
                            'location' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css',
                        ],
                        [
                            'type' => 'js',
                            'asset' => false,
                            'location' => '//cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js',
                        ],
                    ],
                ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
