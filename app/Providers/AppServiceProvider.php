<?php

namespace App\Providers;

use App\Models\Categoria;
use App\Models\Party;
use App\Models\Plan;
use App\Models\Post;
use App\Models\Secretary;
use App\Observers\CategoriaObserver;
use App\Observers\SecretaryObserver;
use App\Observers\PartyObserver;
use App\Observers\PlanObserver;
use App\Observers\PostObserver;
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
        Party::observe(PartyObserver::class);
        Post::observe(PostObserver::class);
        Plan::observe(PlanObserver::class);
        
    }
}
