<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
        
    }
    
    public function profiles($idPlan){
        //dd($idPlan);
        $plan = $this->plan->find($idPlan);        
        if(!$plan){
            return redirect()->back();
        }
        $profiles = $plan->profiles()->paginate(10);

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
       
    }

    public function profilesAvailable(Request $request, $idPlan){

        $plan = $this->plan->find($idPlan);        
        if(!$plan){
            return redirect()->back();
        }
        $pesquisa = $request->except('_token');      
        $profiles = $plan->profilesAvailable($request->pesquisa);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'pesquisa'));
    }

    public function attachProfilesPlans(Request $request, $idPlan){

        $plan = $this->plan->find($idPlan);        
        if(!$plan){
            return redirect()->back();
        }

        if(!$request->profiles  || count($request->profiles) == 0 ){
            toast('É necessário escolher um perfil','error')->toToast('top');
            return redirect()->back();
        }

        $plan->profiles()->attach($request->profiles);
        toast('Perfil(s) vinculada com sucesso!','success')->toToast('top'); 
        return redirect()->route('plans.profiles', $plan->id);

    }

    public function detachProfilesPlan($idPlan, $idProfile){
        
        $plan =  $this->plan->find($idPlan); 
        $profile =  $this->profile->find($idProfile);  

        //dd($plan);
        if(!$plan || !$profile){
            return redirect()->back();
        }

        $plan->profiles()->detach($profile);
        toast('Perfil(s) desvinculada com sucesso!','success')->toToast('top');
        return redirect()->back();
        
    }
    
  
}
