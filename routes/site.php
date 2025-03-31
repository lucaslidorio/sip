<?php

use App\Http\Controllers\Admin\PropositionController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\SitePublicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePublicoController::class, 'index'])->name('site.index');


Route::prefix('/')->group(base_path('routes/legislativo.php'));


Route::any('noticias', [SitePublicoController::class, 'noticiasTodas'])->name('noticias.todas');
Route::get('noticias/{url}', [SitePublicoController::class, 'noticiaShow'])->name('noticias.show');
Route::get('/pagina/{slug}', [SitePublicoController::class, 'page'])->name('pagina');



//Legislativo
Route::get('vereador/{id}', [SitePublicoController::class, 'vereador'])->name('camara.vereador');
Route::get('proposituras', [SitePublicoController::class, 'proposituras'])->name('camara.proposituras');
Route::get('proposituras/{id}', [SitePublicoController::class, 'proposituraShow'])->name('camara.propositura.show');
Route::get('sessoes', [SitePublicoController::class, 'sessoes'])->name('camara.sessoes');
Route::get('sessoes/{id}', [SitePublicoController::class, 'sessaoShow'])->name('camara.sessao.show');

