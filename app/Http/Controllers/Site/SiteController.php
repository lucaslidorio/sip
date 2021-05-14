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
use App\Models\Post;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\AssignOp\Concat;

class SiteController extends Controller
{
    private $tenant, $legislature, $councilor, $function,
    $directorTable, $commission, $post;
    public function __construct(Tenant $tenant, 
                                Legislature $legislature,
                                Councilor $councilor,
                                Functions $function,
                                DirectorTable $directorTable,
                                Commission $commission,
                                Post $post,
                                )
    {
        $this->tenant = $tenant;
        $this->legislature= $legislature;
        $this->councilor = $councilor;
        $this->function = $function;
        $this->directorTable= $directorTable;
        $this->commission = $commission;
        $this->post = $post;

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
   
       $posts = $this->post->where('data_expiracao', null)->orWhere('data_expiracao', '>', '2021-05-12')->get();
               // $dadosComissao = [];
        // for ($i=0; $i < count($commissions) ; $i++) { 
        //     $dadosComissao[$i] ['nome']  = $commissions[$i]->nome;
        //     $dadosComissao[$i] ['id']  = $commissions[$i]->id;
        //     for ($j=0; $j < count($commissions[$i]->members) ; $j++) {                 
        //         $dadosComissao[$i] [$j] ['membros']  = $commissions[$i]->members; 
        //         for ($k=0; $k < count($commissions[$i]->members[$j]->functionCommission) ; $k++) { 
        //             $dadosComissao[$i] [$j] [$k] ['funcao']  = $commissions[$i]->members[$k]->functionCommission;
        //         }
        //     }
        // }



        
        //dd($commissions);
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

    public function noticiaShow($url){
        $post = $this->post->where('url', $url)->first();

        if(!$post)
            return redirect()->back();

        return view('site.layouts.noticiaShow',[
            'post' =>$post
        ]);
    }
}
