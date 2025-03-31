<?php

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\SiteLegislativoController;
use Illuminate\Support\Facades\Route;

//Route::get('/', [SiteLegislativoController::class, 'index'])->name('site.home');


// Route::get('noticias/todas', [SiteLegislativoController::class, 'noticiasTodas'])->name('camara.noticias');
// Route::get('noticias/{todas}', [SiteLegislativoController::class, 'noticiasTodas'])->name('camara.noticias');
// taaaa



//Route::get('/camara/sobre', [SiteLegislativoController::class, 'sobre'])->name('camara.page');mesaDiretora
Route::get('camara/comissoes', [SiteLegislativoController::class, 'comissoes'])->name('camara.comissoes');
Route::get('camara/mesa-diretora', [SiteLegislativoController::class, 'mesaDiretora'])->name('camara.mesaDiretora');
Route::get('camara/legislaturas', [SiteLegislativoController::class, 'legislaturas'])->name('camara.legislaturas');
Route::get('camara/legislaturas/{id}', [SiteLegislativoController::class, 'legislatura'])->name('camara.legislatura');
Route::get('camara/vereadores/show/{id}', [SiteLegislativoController::class, 'vereador'])->name('camara.vereador');
Route::get('camara/sessoes', [SiteLegislativoController::class, 'sessoes'])->name('camara.sessoes');
Route::get('camara/documentos-sessoes', [SiteLegislativoController::class, 'documentosSessoes'])->name('camara.documentosSessoes');
Route::get('camara/pareceres', [SiteLegislativoController::class, 'pareceres'])->name('camara.pareceres');
Route::get('camara/{id}', [SiteLegislativoController::class, 'parecerShow'])->name('camara.parecerShow');
Route::get('camara/comissoes', [SiteLegislativoController::class, 'comissoes'])->name('camara.comissoes');

//Route::get('noticias/todas', [SiteController::class, 'noticiasTodas'])->name('noticias.todas');

Route::get('vereadores/{nome}', [SiteController::class, 'vereadoresShow'])->name('vereadores.show');
Route::get('sessoes', [SiteController::class, 'sessoesIndex'])->name('sessoes.index');
// Route::get('sessoes/{nome}', [SiteController::class, 'sessoesShow'])->name('sessões.show');
Route::get('documentos-sessoes/', [SiteController::class, 'documentosSessoesPesquisar'])->name('documentosSessoes.pesquisar');
// Route::get('proposituras/', [SiteController::class, 'proposituras'])->name('camara.proposituras');
// Route::get('proposituras/{id}', [SiteController::class, 'proposituraShow'])->name('propositura.show');
Route::get('carta-cidadao/{id}', [SiteController::class, 'cartaCidadaoShow'])->name('cartaCidadao.show');
Route::get('legislacoes', [SiteController::class, 'legislacoes'])->name('legislacoes.index');
Route::get('legislacoes/{id}', [SiteController::class, 'legislacaoShow'])->name('legislacao.show');
Route::get('agenda', [SiteController::class, 'agendaIndex'])->name('agenda');
Route::get('/agenda/show', [SiteController::class, 'agendaShow'])->name('agenda.show');
Route::post('contato/', [SiteController::class, 'contato'])->name('contato.enviar');
// Route::get('/', function () {
//     //Alert::success('Success Title', 'Success Message');
//     //toast('Success Toast','success');

//     return view('site/index');
// });