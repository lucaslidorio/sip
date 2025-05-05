<?php

use App\Http\Controllers\Admin\PropositionController;
use App\Http\Controllers\Site\OuvidoriaSiteController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\SitePublicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePublicoController::class, 'index'])->name('site.index');

Route::prefix('/')->group(base_path('routes/legislativo.php'));


Route::any('noticias', [SitePublicoController::class, 'noticiasTodas'])->name('noticias.todas');
Route::get('noticias/{url}', [SitePublicoController::class, 'noticiaShow'])->name('noticias.show');
Route::get('/pagina/{slug}', [SitePublicoController::class, 'page'])->name('pagina');
Route::get('/pesquisar', [SitePublicoController::class, 'pesquisar'])->name('site.pesquisar');
Route::get('/agenda', [SitePublicoController::class, 'agendaIndex'])->name('site.agenda');
Route::get('/agenda/show', [SitePublicoController::class, 'agendaShow'])->name('site.agenda.show');


//Legislativo
Route::get('vereador/{id}', [SitePublicoController::class, 'vereador'])->name('camara.vereador');
Route::get('legislaturas', [SitePublicoController::class, 'legislaturas'])->name('camara.legislaturas'); 
Route::get('legislaturas/{id}/vereadores', [SitePublicoController::class, 'vereadores'])->name('camara.legislatura.vereadores');
Route::get('proposituras', [SitePublicoController::class, 'proposituras'])->name('camara.proposituras');
Route::get('proposituras/{id}', [SitePublicoController::class, 'proposituraShow'])->name('camara.propositura.show');
Route::get('sessoes', [SitePublicoController::class, 'sessoes'])->name('camara.sessoes');
Route::get('sessoes/{id}', [SitePublicoController::class, 'sessaoShow'])->name('camara.sessao.show');
Route::get('mesa-diretora', [SitePublicoController::class, 'mesasDiretoras'])->name('camara.mesas.diretoras');


//ouvidoria
Route::get('/ouvidoria/acompanhamento', [OuvidoriaSiteController::class, 'acompanhamento'])->name('ouvidoria.acompanhamento');
Route::get('/ouvidoria/create/{tipo}', [OuvidoriaSiteController::class, 'create'])->name('ouvidoria.create');
Route::post('/ouvidoria', [OuvidoriaSiteController::class, 'store'])->name('ouvidoria.store');
Route::get('/ouvidoria/confirmacao', [OuvidoriaSiteController::class, 'confirmacao'])->name('ouvidoria.confirmacao');
Route::get('/ouvidoria', [OuvidoriaSiteController::class, 'index'])->name('ouvidoriaSite.index');
Route::get('/ouvidoria/duvidas', [OuvidoriaSiteController::class, 'duvidas'])->name('ouvidoriaSite.duvidas');
