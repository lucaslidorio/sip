<?php

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\SitePublicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePublicoController::class, 'index'])->name('site.index');


Route::prefix('/')->group(base_path('routes/legislativo.php'));


Route::any('noticias', [SitePublicoController::class, 'noticiasTodas'])->name('noticias.todas');
Route::get('noticias/{url}', [SitePublicoController::class, 'noticiaShow'])->name('noticias.show');
Route::get('/pagina/{slug}', [SitePublicoController::class, 'page'])->name('pagina');