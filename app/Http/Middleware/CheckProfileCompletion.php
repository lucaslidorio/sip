<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verifique se o perfil está completo, isso pode variar dependendo do seu modelo de usuário
            if (!$user->profile_complete) {
                // Redirecione para a página de atualização de perfil
                session()->flash('profile_incomplete', true);
                return redirect()->route('users.perfil', ['id' => $user->id]);
            }
        }

        return $next($request);
    }
}
