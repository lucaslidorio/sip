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
use App\Models\Tenant;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class SiteController extends Controller
{
    private $tenant, $legislature, $councilor, $function,
    $directorTable, $commission;
    public function __construct(Tenant $tenant, 
                                Legislature $legislature,
                                Councilor $councilor,
                                Functions $function,
                                DirectorTable $directorTable,
                                Commission $commission,
                                )
    {
        $this->tenant = $tenant;
        $this->legislature= $legislature;
        $this->councilor = $councilor;
        $this->function = $function;
        $this->directorTable= $directorTable;
        $this->commission = $commission;

    }

    public function index(){
         
        $tenants = $this->tenant->where('id', 3)->get();
        $legislatures = $this->legislature->where('atual', 1)->get();

        $directorTables = $this->directorTable->where('atual', 1)->get();
       $dataTables= DirectorTableMemberFunctions::with('members', 'functions')->get();    
       // $dataCommission= CommissionMembers::with('members', 'functions')->get();    
        $commissions = $this->commission->get();
        $councilors = $this->councilor->where('id', 12)->get();
        //dd($councilors);
        return view('site.layouts.app',[
            'tenants' => $tenants,
            'legislatures' => $legislatures,
            'directorTables' => $directorTables,
            'dataTable' => $dataTables,
            'commissions' => $commissions,
            'councilors' => $councilors
            //'dataCommission' =>$dataCommission,
        ]);
    }
}
