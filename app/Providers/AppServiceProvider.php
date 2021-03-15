<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Secretary;
use App\Observers\CategoriaObserver;
use App\Observers\SecretaryObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Categoria::observe(CategoriaObserver::class);
        Secretary::observe(SecretaryObserver::class);
    }
}
