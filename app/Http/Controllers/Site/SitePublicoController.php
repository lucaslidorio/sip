<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SitePublicoController extends Controller
{
    private $tenant, $menu;
    

    public function __construct(Tenant $tenant, Menu $menu) {
        $this->tenant = $tenant;
        $this->menu = $menu;
    }
    
    public function index(){
        $template = view()->shared('currentTemplate');
        $tenant = $this->tenant->first();  
        $menus = $this->menu::whereNull('menu_pai_id')->where('posicao', '1')
        ->orderBy('ordem')
        ->get();
 
        return view("public_templates.$template.index", compact('tenant', 'menus'));
    }


}
