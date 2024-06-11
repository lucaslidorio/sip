<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DadosPessoas;
use App\Models\Profile;
use App\Models\ProfileUser;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $tenant_id = Tenant::first()->id;

        try {
            Auth::login($user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tenant_id' => $tenant_id,
                'password' => Hash::make($request->password),
            ]));

            DadosPessoas::create([
                'user_id' => $user->id,
                'email' =>$user->email
            ]);

            $profile  = Profile::where('nome',  'Credenciados')->first();
            if($profile){
                ProfileUser::create([
                    'user_id' => $user->id,
                    'profile_id' => $profile->id,
                ]);
            }else{
                toast('Erro ao salvar! Perfil não encontrado','danger')->toToast('top') ;
                return redirect()->back();
            }
          

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return back()->withErrors(['error' => 'Erro ao salvar as informações.']); 
        }

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
