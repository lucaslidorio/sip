<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Models\Tenant;

class SetTemplate
{
    public function handle($request, Closure $next)
    {
        // Busca o template configurado para este cliente
        $tenant = Tenant::first();

        if ($tenant) {
            // Compartilha o template com todas as views
            View::share('currentTemplate', $tenant->template);
        } else {
            // Fallback para o template padrão
            View::share('currentTemplate', 'default');
        }

        return $next($request);
    }
}
