<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $profile, $user;
    public function __construct(Profile $profile, User $user)
    {
        $this->profile = $profile;
        $this->user = $user;
    }

    public function users($idProfile)
    {
        $this->authorize('admin');
        $profile = $this->profile->find($idProfile);

        if (!$profile) {
            return redirect()->back();
        }
        $users = $profile->users()->paginate();
        
        return view('admin.pages.profiles.users.users', compact('profile', 'users'));      
     }

//Vincula permissão com o perfil
public function attachProfileUser(Request $request, $idProfile){
    $this->authorize('admin');
    $profile =  $this->profile->find($idProfile);       
    if(!$profile){
        return redirect()->back();
    }


    
    if(!$request->users  || count($request->users) == 0){
        toast('É necessário escolher um usuário','error')->toToast('top');
        return redirect()->back();
        
    }

    $profile->users()->attach($request->users);
    toast('Usuário(s) vinculado com sucesso!','success')->toToast('top');
    return redirect()->route('profiles.users', $profile->id);

}


public function usersAvailable(Request $request , $idProfile){
    $this->authorize('admin');
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');
       
        
        $users = $profile->usersAvailable($request->pesquisa);
            
        return view('admin.pages.profiles.users.available', compact('profile', 'users'));

    }


    public function detachProfileUser ($idProfile, $idUser){
        $this->authorize('admin');
        
        $profile = $this->profile->find($idProfile);
        $user = $this->user->find($idUser);     
        
        if (!$profile || !$user) {
            return redirect()->back();
        }

        $profile->users()->detach($user);    
        return redirect()->route('profiles.users', $profile->id);

    }

  



    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
