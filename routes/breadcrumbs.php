<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Councilor;
use App\Models\Legislature;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Início', route('site.home'));
});

// Home > páginas > [pagina]
Breadcrumbs::for('page', function (BreadcrumbTrail $trail, $page) {
    $trail->parent('home');
    $trail->push($page->titulo, route('pagina', $page));
});
// Home > Agenda
Breadcrumbs::for('agenda', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Agenda', route('agenda'));
});

// Home > Noticias
Breadcrumbs::for('noticias', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Notícias', route('noticias.todas'));
});
// Home > Noticias > [Noticia]
Breadcrumbs::for('noticia', function (BreadcrumbTrail $trail, $noticia) {
    $trail->parent('noticias');
    $trail->push($noticia->titulo, route('noticias.todas', $noticia));
});
// Home > Legislaturas
Breadcrumbs::for('legislaturas', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Legislaturas', route('camara.legislaturas'));
});
// Home > Legislatura > [Legislatura]
Breadcrumbs::for('legislatura', function (BreadcrumbTrail $trail, $legislature) {
    $trail->parent('legislaturas');
    $trail->push($legislature->descricao, route('camara.legislatura', $legislature));
});
// // Home > Legislaturas > Legislatura [vereador]
// Breadcrumbs::for('vereador', function (BreadcrumbTrail $trail, $vereador) {
//     $trail->parent('legislatura');
//     $trail->push($vereador->nome, route('camara.vereador', $vereador));
// });

// Home > Sessão > 
Breadcrumbs::for('sessoes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Sessões', route('camara.sessoes'));
});
// Home > Sessão > 
Breadcrumbs::for('documentos_sessao', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Documentos da Sessão', route('camara.documentosSessoes'));
});

// Home > Comissões > 
Breadcrumbs::for('comissoes', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Comissões', route('camara.comissoes'));
});

// Home > Comissões >Pareceres 
Breadcrumbs::for('pareceres_comissao', function (BreadcrumbTrail $trail) {
    $trail->parent('comissoes');
    $trail->push('Pareceres', route('camara.pareceres'));
});
// Home > Comissões >Pareceres  > [parecer]
Breadcrumbs::for('parecer', function (BreadcrumbTrail $trail, $seemCommission) {
    $trail->parent('pareceres_comissao');
    $trail->push($seemCommission->assunto, route('camara.parecerShow', $seemCommission));
});

// Home > Proposituras > 
Breadcrumbs::for('proposituras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Propositura', route('camara.proposituras'));
});
// Home > Proposituras > [propositura]
Breadcrumbs::for('propositura', function (BreadcrumbTrail $trail, $propositura) {
    $trail->parent('proposituras');
    $trail->push($propositura->type_proposition->nome, route('propositura.show', $propositura));
});

// Home > Mesa Diretora > 
Breadcrumbs::for('mesas_diretora', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mesas Diretoras', route('camara.mesaDiretora'));
});
// Home > Mapa do Site > 
Breadcrumbs::for('siteMap', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mapa do Site', route('site.mapa'));
});
// Home > Pesquisa > 
Breadcrumbs::for('pesquisa', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pesquisa', route('site.pesquisar'));
});
// Home > Acessibilidade > 
Breadcrumbs::for('acessibilidade', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Acessibilidade', route('site.acessibilidade'));
});
// Home > Enquete 
Breadcrumbs::for('enquete', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Enquete', route('site.home'));
});
// Home > Enquete > [nome]
Breadcrumbs::for('enquete_nome', function (BreadcrumbTrail $trail, $enquete) {
    $trail->parent('enquete');
    $trail->push($enquete->nome, route('propositura.show', $enquete));
});
// Home > Ouvidoria  
Breadcrumbs::for('ouvidoria_index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ouvidoria', route('ouvidoriaSite.index'));
});
// Home > Ouvidoria  
Breadcrumbs::for('ouvidoria_duvidas', function (BreadcrumbTrail $trail) {
    $trail->parent('ouvidoria_index');
    $trail->push('Dúvidas', route('ouvidoriaSite.duvidas'));
});
// Home > Procesos  
Breadcrumbs::for('processo_compras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Processos de compras', route('processoCompras.index'));
});
// Home > Ouvidoria >[Tipo]
Breadcrumbs::for('ouvidora_tipo', function (BreadcrumbTrail $trail, $tipo_ouvidoria) {
    $trail->parent('ouvidoria_index');
    $trail->push($tipo_ouvidoria->nome, route('propositura.show', $tipo_ouvidoria));
});
// Home > Ouvidoria >[Acompanhamento]
Breadcrumbs::for('ouvidora_acompanhamento', function (BreadcrumbTrail $trail, $ouvidoria) {
    $trail->parent('ouvidoria_index');
    $trail->push($ouvidoria->codigo, route('ouvidoria.acompanhamento', $ouvidoria));
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
    $trail->push($vereador->nome, route('camara.vereador', $vereador));
    
// Home > Compras e Licitacaoes  
Breadcrumbs::for('processo_compras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Processos de Compras', route('processoCompras.index'));
});

});