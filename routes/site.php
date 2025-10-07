<?php

use App\Http\Controllers\Admin\PropositionController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\LicitacoesController;
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
Route::get('/politica-privacidade', [SitePublicoController::class, 'politicaPrivacidade'])->name('site.politica.privacidade');
Route::get('/agenda', [SitePublicoController::class, 'agendaIndex'])->name('site.agenda');
Route::get('/agenda/show', [SitePublicoController::class, 'agendaShow'])->name('site.agenda.show');
Route::get('/sitemap', [SitePublicoController::class, 'sitemap'])->name('site.mapa');
Route::get('/acessibilidade', [SitePublicoController::class, 'acessibilidade'])->name('site.acessibilidade');
Route::get('/pesquisa-satisfacao', [SitePublicoController::class, 'pesquisaSatisfacao'])->name('site.pesquisa');
Route::post('/pesquisa-satisfacao/responder', [SitePublicoController::class, 'pesquisaSatisfacaoResponder'])->name('site.pesquisa.responder');
Route::get('/pesquisa/{id}/estatisticas', [SitePublicoController::class, 'estatisticas'])->name('site.pesquisa.resultado');

Route::get('/contato', [ContatoController::class, 'index'])->name('site.contato');
Route::post('/contato/enviar', [ContatoController::class, 'enviar'])->name('site.contato.enviar');
Route::get('/legislacao', [SitePublicoController::class, 'legislacao'])->name('site.legislacao.index');

//Executivo
Route::get('/secretarias', [SitePublicoController::class, 'secretarias'])->name('site.secretarias.index');
Route::get('/secretarias/{sigla}', [SitePublicoController::class, 'secretariaShow'])->name('site.secretarias.show');

//Executivo - Licitações e processo de compras

 // Página principal - listagem de licitações
    Route::get('/compras', [LicitacoesController::class, 'index'])->name('site.compras.index');    
    // Página de detalhes de uma licitação específica
    Route::get('/compras/{id}', [LicitacoesController::class, 'show'])->where('id', '[0-9]+')->name('site.compras.show');    
    // Exportação de dados
    Route::get('/compras/export', [LicitacoesController::class, 'export'])->name('site.compras.export');    
    // Estatísticas (para dashboard ou widgets)
    Route::get('/api/estatisticas', [LicitacoesController::class, 'estatisticas'])->name('site.compras.estatisticas');    
    // Busca AJAX para autocomplete
    Route::get('/api/search', [LicitacoesController::class, 'search'])->name('search');    
    // Busca avançada (API)
    Route::post('/api/busca-avancada', [LicitacoesController::class, 'buscaAvancada'])->name('busca-avancada');


//Legislativo
Route::get('vereador/{id}', [SitePublicoController::class, 'vereador'])->name('camara.vereador');Route::get('pronunciamentos/{id}', [SitePublicoController::class, 'pronunciamentoShow'])->name('camara.pronunciamento.show');
Route::get('pronunciamentos', [SitePublicoController::class, 'pronunciamentos'])->name('camara.pronunciamentos');
Route::get('pronunciamentos/{id}', [SitePublicoController::class, 'pronunciamentoShow'])->name('camara.pronunciamento.show');

Route::get('legislaturas', [SitePublicoController::class, 'legislaturas'])->name('camara.legislaturas'); 
Route::get('legislaturas/{id}/vereadores', [SitePublicoController::class, 'vereadores'])->name('camara.legislatura.vereadores');
Route::get('proposituras', [SitePublicoController::class, 'proposituras'])->name('camara.proposituras');
Route::get('proposituras/{id}', [SitePublicoController::class, 'proposituraShow'])->name('camara.propositura.show');
Route::get('sessoes', [SitePublicoController::class, 'sessoes'])->name('camara.sessoes');
Route::get('sessoes/{id}', [SitePublicoController::class, 'sessaoShow'])->name('camara.sessao.show');
Route::get('documentos-sessoes/{tipo_id?}', [SitePublicoController::class, 'documentosSessoes'])->name('camara.documetos.sessoes');

Route::get('mesa-diretora', [SitePublicoController::class, 'mesasDiretoras'])->name('camara.mesas.diretoras');
Route::get('comissoes', [SitePublicoController::class, 'comissoes'])->name('camara.comissoes');
Route::get('comissoes/{id}', [SitePublicoController::class, 'comissaoShow'])->name('camara.comissao.show');
Route::get('pareceres', [SitePublicoController::class, 'pareceres'])->name('camara.pareceres');
Route::get('pareceres/{id}', [SitePublicoController::class, 'parecerShow'])->name('camara.parecer.show');



//ouvidoria
Route::get('/ouvidoria/acompanhamento', [OuvidoriaSiteController::class, 'acompanhamento'])->name('ouvidoria.acompanhamento');
Route::get('/ouvidoria/create/{tipo}', [OuvidoriaSiteController::class, 'create'])->name('ouvidoria.create');
Route::post('/ouvidoria', [OuvidoriaSiteController::class, 'store'])->name('ouvidoria.store');
Route::get('/ouvidoria/confirmacao', [OuvidoriaSiteController::class, 'confirmacao'])->name('ouvidoria.confirmacao');
Route::get('/ouvidoria', [OuvidoriaSiteController::class, 'index'])->name('ouvidoriaSite.index');
Route::get('/ouvidoria/duvidas', [OuvidoriaSiteController::class, 'duvidas'])->name('ouvidoriaSite.duvidas');
