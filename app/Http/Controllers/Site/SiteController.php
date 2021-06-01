<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\CommissionMembers;
use App\Models\Councilor;
use App\Models\DirectorTable;
use App\Models\DirectorTableMemberFunctions;
use App\Models\Functions;
use App\Models\Legislature;
use App\Models\Minute;
use App\Models\Post;
use App\Models\Section;
use App\Models\Tenant;
use App\Models\TypeMinutes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;

class SiteController extends Controller
{
    private $tenant, $legislature, $councilor, $function,
    $directorTable, $commission, $post, $minute,
    $section, $type;
    public function __construct(Tenant $tenant, 
                                Legislature $legislature,
                                Councilor $councilor,
                                Functions $function,
                                DirectorTable $directorTable,
                                Commission $commission,
                                Post $post,
                                Minute $minute,
                                Section $section,
                                TypeMinutes $type,
                                )
    {
        $this->tenant = $tenant;
        $this->legislature= $legislature;
        $this->councilor = $councilor;
        $this->function = $function;
        $this->directorTable= $directorTable;
        $this->commission = $commission;
        $this->post = $post;
        $this->minute =  $minute;
        $this->section = $section;
        $this->type = $type;

    }

    public function index(){
         
        $tenants = $this->tenant->where('id', 3)->get();
        $legislatures = $this->legislature->where('atual', 1)->get();
        //pega as mesa diretoras
        $directorTables = $this->directorTable->where('atual', 1)->get();        
        
        $commissions = $this->commission->get();
        //pega os membros das comissões        
        foreach ($commissions as $comissao) {
            $id = $comissao->id;
            $membrosComissao [] = CommissionMembers::with('members', 'functions')->where('commission_id', $id)->get(); 
        }      

        $councilors = $this->councilor->where('atual', 1 )->get();
       /// $now = Carbon::now();
   
       //recupera as noticias e mostra na tela as 6 utimas
       $posts = $this->post->where('data_expiracao', null)->orWhere('data_expiracao', '>', '2021-05-12')
       ->orderBy('created_at', 'DESC')
       ->limit(6)
       ->get();

        return view('site.layouts.app',[
            'tenants' => $tenants,
            'legislatures' => $legislatures,
            'directorTables' => $directorTables,
            'membrosComissao' => $membrosComissao,
            'commissions' => $commissions,
            'councilors' => $councilors,
            'posts' => $posts,
            
        ]);
    }

    public function vereadoresShow($nome){

        $vereador = $this->councilor->where('nome', $nome)->first();
        
        if(!$vereador)
            return redirect()->back();

        $tenants = $this->tenant->where('id', 3)->get(); 
        $councilors = $this->councilor->where('atual', 1 )->get();
        
        
        return view('site.layouts.vereadoresShow',[                
            'tenants' =>  $tenants,
            'vereador' => $vereador,
            'councilors' =>$councilors,
        ]);
    }

    public function noticiaShow($url){

        $post = $this->post->where('url', $url)->first();
        
        if(!$post)
            return redirect()->back();

        $tenants = $this->tenant->where('id', 3)->get(); 
        $posts = $this->post->where('secretary_id',$post->secretary_id)
                  ->where(function ($query) {
                        $query->where('data_expiracao', null)
                          ->orWhere('data_expiracao', '>=', Carbon::now()->format('d-m-Y'));                          
                  })
                  ->orderBy('created_at', 'DESC')
                  ->limit(4)
                  ->get();
        
        return view('site.layouts.noticiaShow',[
            'post' =>$post,
            'posts' =>$posts,           
            'tenants' =>  $tenants,
        ]);
    }

    public function atasIndex(Request $request){
        $tenants = $this->tenant->where('id', 3)->get();
        $types = $this->type->get();        
        $councilors = $this->councilor->where('atual', 1)->get();
        $legislatures = $this->legislature->get();
        $sections = $this->section->get();


        $filters = $request->except('_token');
       
    
        $minutes = $this->minute        
        ->when($request->type_minute_id, function($query, $role){
            return $query->where('type_minute_id', $role);
        })
        ->when($request->legislature_id, function($query, $role){
            return $query->where('legislature_id', $role);
        })   
        ->when($request->legislature_section_id, function($query, $role){
            return $query->where('legislature_section_id', $role);
        })         
        ->paginate(10);

        return view('site.layouts.atas',[                         
            'tenants' =>  $tenants,
            'minutes' => $minutes,
            'councilors' =>$councilors,
            'legislatures' => $legislatures,
            'sections' => $sections,
            'types' => $types,
            'filters' => $filters,
                
        ]);

    }
}
