<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SiteVisit;
use Illuminate\Support\Facades\Log;

class TrackSiteVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Registra a visita apenas para rotas públicas (não admin)
        // Usa terminate() para não bloquear a resposta
        return $next($request);
    }
    
    /**
     * Perform any final actions for the request lifecycle.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        if (!$request->is('admin*') && !$request->is('api*')) {
            try {
                SiteVisit::registerVisit($request);
            } catch (\Exception $e) {
                // Silenciosamente ignora erros para não afetar a experiência do usuário
                Log::error('Erro ao registrar visita: ' . $e->getMessage());
            }
        }
    }
}
