<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Início', route('site.index'), ['icon' =>'fas fa-home']);
});


// Home > páginas > [pagina]
Breadcrumbs::for('page', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('home');
    $trail->push($page->titulo, route('pagina', $page), ['icon' => 'fas fa-file-alt']);
});
// Home > Agenda
Breadcrumbs::for('agenda', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Agenda', route('agenda'), ['icon' => 'fas fa-calendar-alt']);
});

// Home > Noticias
Breadcrumbs::for('noticias', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Notícias', route('noticias.todas'),['icon' =>'fas fa-newspaper'] );
});
// Home > Noticias > [Noticia]
Breadcrumbs::for('noticia', function (BreadcrumbTrail $trail, $noticia) {
    $trail->parent('noticias');
    $trail->push($noticia->titulo, route('noticias.todas', $noticia),['icon' =>'fab fa-readme'] );
});
// Home > Secretarias
Breadcrumbs::for('secretarias', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Secretarias', route('site.secretarias.index'),['icon' =>'fas fa-network-wired'] );
});
// Home > Secretarias > [Secretaria]
Breadcrumbs::for('secretaria', function (BreadcrumbTrail $trail, $secretaria) {
    $trail->parent('secretarias');
    $trail->push($secretaria->nome, route('site.secretarias.show', $secretaria),['icon' =>'fas fa-building'] );
});


// Home > Procesos  
Breadcrumbs::for('processo_compras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Processos de compras', route('site.compras.index'),['icon' =>'fas fa-gavel me-1'] );
});
// Home > Processo de compras > [Processo]
Breadcrumbs::for('processo', function (BreadcrumbTrail $trail, $processo) {
    $trail->parent('processo_compras');
    $trail->push($processo->numero, route('site.compras.show', $processo),['icon' =>'fas fa-file-alt'] );
});

// Home > Pesquisa de satisfação
Breadcrumbs::for('pesquisa_satisfacao', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pesquisa de Satisfação', route('site.pesquisa'), ['icon' => 'fas fa-poll']);
});
Breadcrumbs::for('estatisticas', function (BreadcrumbTrail $trail) {
    $trail->parent('pesquisa_satisfacao');
    $trail->push('Estatistícas', route('site.pesquisa'), ['icon' => 'fas fa-chart-bar']);
});

// Home > Legislaturas
Breadcrumbs::for('legislaturas', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Legislaturas', route('camara.legislaturas'), ['icon' => 'fas fa-landmark']);
});
// Home > Legislatura > [Legislatura]
Breadcrumbs::for('legislatura', function (BreadcrumbTrail $trail, $legislature) {
    $trail->parent('legislaturas');
    $trail->push($legislature->descricao, route('camara.legislatura.vereadores', $legislature), ['icon' => 'fas fa-calendar-alt']);
});


// Home > Sessão > 
Breadcrumbs::for('sessoes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sessões', route('camara.sessoes'), ['icon' => 'fas fa-users-class']);
});

Breadcrumbs::for('sessao', function (BreadcrumbTrail $trail, $sessao) {
    $trail->parent('sessoes');
    $trail->push($sessao->nome, route('camara.sessao.show', $sessao), ['icon' => 'fas fa-handshake']);
});

Breadcrumbs::for('documentos_sessoes', function (BreadcrumbTrail $trail) {
    $trail->parent('sessoes');
    $trail->push('Documentos das Sessões', route('camara.documetos.sessoes'), ['icon' => 'fas fa-file-alt']);
});

// Home > Sessão > 
Breadcrumbs::for('documentos_sessao', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Documentos da Sessão', route('camara.documentosSessoes'), ['icon' => 'fas fa-folder-open']);
});

// Home > Comissões > 
Breadcrumbs::for('comissoes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Comissões', route('camara.comissoes'), ['icon' => 'fas fa-users']);
});
Breadcrumbs::for('comissao', function (BreadcrumbTrail $trail, $comissao) {
    $trail->parent('comissoes');
    $trail->push($comissao->nome, route('camara.comissao.show', $comissao), ['icon' => 'fas fa-user-friends']);
});
Breadcrumbs::for('pareceres', function (BreadcrumbTrail $trail) {
    $trail->parent('comissoes');
    $trail->push('Pareceres das comissões', route('camara.pareceres'), ['icon' => 'fas fa-file-signature']);
});
// Home > Comissões >Pareceres  > [parecer]
Breadcrumbs::for('parecer', function (BreadcrumbTrail $trail, $parecer) {
    $trail->parent('pareceres');
    $nome = $parecer->proposition->tipo->nome . ' ' . $parecer->proposition->numero;
    $trail->push($nome, route('camara.parecer.show', $parecer), ['icon' => 'fas fa-gavel']);
});

// Home > Comissões >Pareceres 
Breadcrumbs::for('pareceres_comissao', function (BreadcrumbTrail $trail) {
    $trail->parent('comissoes');
    $trail->push('Pareceres', route('camara.pareceres'), ['icon' => 'fas fa-file-signature']);
});


// Home > Proposituras > 
Breadcrumbs::for('proposituras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Propositura', route('camara.proposituras'), ['icon' => 'fas fa-file-invoice']);
});
// Home > Proposituras > [propositura]
Breadcrumbs::for('propositura', function (BreadcrumbTrail $trail, $propositura) {
    $trail->parent('proposituras');
    $trail->push($propositura->type_proposition->nome, route('camara.propositura.show', $propositura), ['icon' => 'fas fa-file-alt']);
});
// Home > Pronunciamentos
Breadcrumbs::for('pronunciamentos', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pronunciamentos', route('camara.pronunciamentos'), ['icon' => 'fas fa-microphone']);
});
// Home > Pronunciamentos -> [pronunciamento]
Breadcrumbs::for('pronunciamento', function (BreadcrumbTrail $trail, $pronunciamento) {
    $trail->parent('pronunciamentos');   
    $trail->push($pronunciamento->session->nome, route('camara.pronunciamento.show', $pronunciamento), ['icon' => 'fas fa-comment-dots']);
});

// Home > Mesa Diretora > 
Breadcrumbs::for('mesas_diretora', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mesas Diretoras', route('camara.mesas.diretoras'), ['icon' => 'fas fa-chalkboard-teacher']);
});
// Home > Mapa do Site > 
Breadcrumbs::for('siteMap', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mapa do Site', route('site.mapa'), ['icon' => 'fas fa-sitemap']);
});
// Home > Pesquisa > 
Breadcrumbs::for('pesquisa', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pesquisa', route('site.pesquisar'), ['icon' => 'fas fa-search']);
});
// Home > Acessibilidade > 
Breadcrumbs::for('acessibilidade', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Acessibilidade', route('site.acessibilidade'), ['icon' => 'fas fa-universal-access']);
});
// Home > Enquete 
Breadcrumbs::for('enquete', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Enquete', route('site.home'), ['icon' => 'fas fa-poll-h']);
});
// Home > Enquete > [nome]
Breadcrumbs::for('enquete_nome', function (BreadcrumbTrail $trail, $enquete) {
    $trail->parent('enquete');
    $trail->push($enquete->nome, route('propositura.show', $enquete), ['icon' => 'fas fa-vote-yea']);
});

// Home > Diário Oficial  
Breadcrumbs::for('diario_oficial', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Publicações Diário Oficial', route('publicacoes.dof'), ['icon' => 'fas fa-newspaper']);
});

Breadcrumbs::for('diario_oficial_publicacao', function (BreadcrumbTrail $trail, $documento) {
    $trail->parent('diario_oficial');
    $trail->push($documento->titulo, route('ouvidoria.acompanhamento', $documento), ['icon' => 'fas fa-file-pdf']);
});






// Home > Ouvidoria  
Breadcrumbs::for('ouvidoria_index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ouvidoria', route('ouvidoriaSite.index'), ['icon' => 'fas fa-headset']);
});
// Home > Ouvidoria  
Breadcrumbs::for('ouvidoria_duvidas', function (BreadcrumbTrail $trail) {
    $trail->parent('ouvidoria_index');
    $trail->push('Dúvidas', route('ouvidoriaSite.duvidas'), ['icon' => 'fas fa-question-circle']);
});

// Home > Ouvidoria >[Tipo]
Breadcrumbs::for('ouvidora_tipo', function (BreadcrumbTrail $trail, $tipo_ouvidoria) {
    $trail->parent('ouvidoria_index');
    $trail->push($tipo_ouvidoria->nome, route('ouvidoria.create', $tipo_ouvidoria), ['icon' => 'fas fa-comments']);
});
// Home > Ouvidoria >[Acompanhamento]
Breadcrumbs::for('ouvidora_acompanhamento', function (BreadcrumbTrail $trail, $ouvidoria) {
    $trail->parent('ouvidoria_index');
    $trail->push($ouvidoria->codigo, route('ouvidoria.acompanhamento', $ouvidoria), ['icon' => 'fas fa-clipboard-check']);
});

Breadcrumbs::for('vereador', function (BreadcrumbTrail $trail, $vereador) {
    // Obter as legislaturas do vereador
    $legislaturas = $vereador->legislatures->sortByDesc('id'); // Ordenar por data de criação (mais recente primeiro)

    // Identificar a legislatura anterior
    $legislatureAnterior = null;
    foreach ($legislaturas as $legislature) {
        if ($legislature->id != $vereador->legislature_id) { // Verificar se não é a legislatura atual
            $legislatureAnterior = $legislature;
            break;
        }
    }    
    // Definir o breadcrumb parent (se a legislatura anterior existir)
    if ($legislatureAnterior) {
        $trail->parent('legislatura', $legislatureAnterior);
    }
    $trail->push($vereador->nome, route('camara.vereador', $vereador), ['icon' => 'fas fa-user-tie']);
});