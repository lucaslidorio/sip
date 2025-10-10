<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\ACL\ProfileUserController;
use App\Http\Controllers\Admin\AlternativaPesquisaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\CitizenLetterController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\ConfiguracaoOuvidoriaController;
use App\Http\Controllers\Admin\CouncilorController;
use App\Http\Controllers\Admin\CredenciamentoProcessoComprasController;
use App\Http\Controllers\Admin\DadosPessoasController;
use App\Http\Controllers\Admin\DirectorTableController;
use App\Http\Controllers\Admin\DocumentoDofController;
use App\Http\Controllers\Admin\EnqueteController;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LegislationController;
use App\Http\Controllers\Admin\LegislatureController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MinuteController;
use App\Http\Controllers\Admin\OuvidoriaController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PartyController;
use App\Http\Controllers\Admin\PerguntaPesquisaController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PopupsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProcessoCompraController;
use App\Http\Controllers\Admin\PronunciamentoController;
use App\Http\Controllers\Admin\PropositionController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\SeemCommissionController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\SetoresController;
use App\Http\Controllers\Admin\SubTipoMateriaController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\TipoMateriaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserFunctionController;
use App\Http\Controllers\Site\OuvidoriaSiteController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\SitePublicoController;
use Illuminate\Support\Facades\Route;


//Grupo de roda para Middleware de autenticação

Route::middleware(['auth', 'verified'])->group(function () {


    Route::middleware(['auth', 'profile.complete'])->group(function () {
          //Rota da dashboard (home)   
        Route::get('home', [HomeController::class, 'index'])->name('dashboard.index');

    });

  
    Route::prefix('admin')
        ->namespace('Admin')
        ->group(function () {

            Route::prefix('legislativo')
                ->namespace('Legislativo')
                ->group(function () {
                    //Rotas de Lesgislaturas x Vereadores
                    Route::get('/legislatures/councilors/{id}', [LegislatureController::class, 'councilorsDestroy'])->name('legislatureCouncilorsDestroy.destroy');
                    Route::post('/legislatures/{id}/councilors', [LegislatureController::class, 'councilorsStore'])->name('legislatureCouncilorsStore.store');
                    Route::get('/legislatures/{id}/councilors/create', [LegislatureController::class, 'councilorsCreate'])->name('legislatureCouncilorsCreate.create');
                    Route::get('/legislatures/{id}/councilors', [LegislatureController::class, 'councilors'])->name('legislatureCouncilors.index');

                    Route::get('/legislatures/show/{id}', [LegislatureController::class, 'show'])->name('legislatures.show');
                    //Route::get('/legislatures/create', [LegislatureController::class, 'create'])->name('legislatures.create');
                    Route::get('/legislatures/{id}', [LegislatureController::class, 'destroy'])->name('legislatures.destroy');
                    Route::post('/legislatures', [LegislatureController::class, 'store'])->name('legislatures.store');
                    Route::get('/legislatures', [LegislatureController::class, 'index'])->name('legislatures.index');

                    //Rotas de Vereadores, admin/legislativo/councilors
                    Route::any('/councilors/search', [CouncilorController::class, 'search'])->name('councilors.search');
                    Route::put('/councilors/{id}', [CouncilorController::class, 'update'])->name('councilors.update');
                    Route::get('/councilors/{id}/edit', [CouncilorController::class, 'edit'])->name('councilors.edit');
                    Route::get('/councilors/show/{id}', [CouncilorController::class, 'show'])->name('councilors.show');
                    Route::get('/councilors/create', [CouncilorController::class, 'create'])->name('councilors.create');
                    Route::get('/councilors/{id}', [CouncilorController::class, 'destroy'])->name('councilors.destroy');
                    Route::post('/councilors', [CouncilorController::class, 'store'])->name('councilors.store');
                    Route::get('/councilors', [CouncilorController::class, 'index'])->name('councilors.index');
                    //Rotas de Sessão             

                    //Route::any('/sessions/search', [SessionController::class, 'search'])->name('sessions.search');
                    Route::put('/sessions/{id}', [SessionController::class, 'update'])->name('sessions.update');
                    Route::get('/sessions/{id}/presentCreate', [SessionController::class, 'createPresentCouncilor'])->name('sessionPresentCreate.create');
                    Route::post('/sessions/{id}/presentStore', [SessionController::class, 'storePresentCouncilor'])->name('sessionPresentStore.store');
                    Route::get('/sessions/{id}/presentEdit', [SessionController::class, 'editPresentCouncilor'])->name('sessionPresentEdit.edit');
                    Route::put('/sessions/{id}/presentUpdate', [SessionController::class, 'updatePresentCouncilor'])->name('sessionPresentUpdate.update');
                    Route::get('/sessions/{id}/attachmentCreate', [SessionController::class, 'createAttachment'])->name('sessionAttachmentCreate.create');
                    Route::post('/sessions/attachmentStore', [SessionController::class, 'storeAttachment'])->name('sessionAttachmentStore.store');
                    Route::get('/sessions/attachmentDelete/{id}', [SessionController::class, 'deleteAttachment'])->name('sessionAttachmentDelete.delete');
                    Route::get('/sessions/show/{id}', [SessionController::class, 'show'])->name('sessions.show');
                    Route::get('/sessions/{id}/edit', [SessionController::class, 'edit'])->name('sessions.edit');
                    Route::get('/sessions/create', [SessionController::class, 'create'])->name('sessions.create');
                    //Route::get('/sessions/{id}', [SessionController::class, 'destroy'])->name('sessions.destroy');
                    Route::post('/sessions', [SessionController::class, 'store'])->name('sessions.store');
                    Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');
                });
            //Rotas de layouts
            Route::prefix('layout')
                ->namespace('layout')
                ->group(function () {


                    // Route::any('/menus/search', [PartyController::class, 'search'])->name('menus.search');
                    // Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
                    // Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
                    // Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
                    // Route::get('/menus/{id}', [MenuController::class, 'destroy'])->name('menus.destroy');
                    // Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
                    // Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');

                    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('admin.menus.edit');
                    Route::get('/menus/create', [MenuController::class, 'create'])->name('admin.menus.create');
                    Route::get('/menus/show/{id}', [MenuController::class, 'show'])->name('admin.menus.show');
                    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('admin.menus.update');
                   
                    Route::delete('/menus/{id}', [MenuController::class, 'destroy'])->name('admin.menus.destroy');
                    Route::post('/menus', [MenuController::class, 'store'])->name('admin.menus.store');
                    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');
                    
                    
                    //Route::resource('menus',[MenuController::class]);
                    Route::post('menus/reorder', [MenuController::class, 'reorder'])->name('admin.menus.reorder');
                    Route::post('menus/{id}/toggle', [MenuController::class, 'toggleStatus'])->name('admin.menus.toggle');                    
                    Route::get('menus/preview', [MenuController::class, 'preview'])->name('admin.menus.preview');
                

                    Route::put('/links/{id}', [LinkController::class, 'update'])->name('links.update');
                    Route::get('/links/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
                    Route::get('/links/create', [LinkController::class, 'create'])->name('links.create');
                    Route::get('/links/{id}', [LinkController::class, 'destroy'])->name('links.destroy');
                    Route::post('/links', [LinkController::class, 'store'])->name('links.store');
                    Route::get('/links', [LinkController::class, 'index'])->name('links.index');

                    Route::put('/pages/{id}', [PagesController::class, 'update'])->name('pages.update');
                    Route::get('/pages/{id}/edit', [PagesController::class, 'edit'])->name('pages.edit');
                    Route::get('/pages/create', [PagesController::class, 'create'])->name('pages.create');
                    Route::get('/pages/{id}', [PagesController::class, 'destroy'])->name('pages.destroy');
                    Route::post('/pages', [PagesController::class, 'store'])->name('pages.store');
                    Route::get('/pages', [PagesController::class, 'index'])->name('pages.index');
                    Route::get('/pages/deleteAttachment/{id}', [PagesController::class, 'deleteAttachment'])->name('pages.deleteAttachment');
                });

            //Rotas de orgãos
            Route::any('/tenants/search', [TenantController::class, 'search'])->name('tenants.search');
            Route::put('/tenants/{id}', [TenantController::class, 'update'])->name('tenants.update');
            Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
            Route::get('/tenants/show/{id}', [TenantController::class, 'show'])->name('tenants.show');
            Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
            Route::get('/tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
            Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
            Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');


            Route::get('tenants/{id}/anexos',  [TenantController::class, 'anexos'])->name('tenants.anexos');
            Route::post('tenants/{id}/anexos', [TenantController::class, 'storeAnexo'])->name('tenants.anexos.store');
            Route::delete('tenants/{id}/anexos/{anexo_id}', [TenantController::class, 'destroyAnexo'])->name('tenants.anexos.destroy');
            Route::patch('tenants/{id}/anexos/{anexo_id}/toggle', [TenantController::class, 'toggleSituacaoAnexo'])->name('tenants.anexos.toggle');

            //Rotas de leis             
            Route::any('/legislations/search', [LegislationController::class, 'search'])->name('legislations.search');
            Route::put('/legislations/{id}', [LegislationController::class, 'update'])->name('legislations.update');
            Route::get('/legislations/deleteAttachment/{id}', [LegislationController::class, 'deleteAttachment'])->name('legislations.deleteAttachment');
            Route::get('/legislations/show/{id}', [LegislationController::class, 'show'])->name('legislations.show');
            Route::get('/legislations/{id}/edit', [LegislationController::class, 'edit'])->name('legislations.edit');
            Route::get('/legislations/create', [LegislationController::class, 'create'])->name('legislations.create');
            Route::get('/legislations/{id}', [LegislationController::class, 'destroy'])->name('legislations.destroy');
            Route::post('/legislations', [LegislationController::class, 'store'])->name('legislations.store');
            Route::get('/legislations', [LegislationController::class, 'index'])->name('legislations.index');

            //Rotas de pareceres             
            Route::any('/seemCommissions/search', [SeemCommissionController::class, 'search'])->name('seemCommissions.search');
            Route::put('/seemCommissions/{id}', [SeemCommissionController::class, 'update'])->name('seemCommissions.update');
            Route::get('/seemCommissions/deleteAttachment/{id}', [SeemCommissionController::class, 'deleteAttachment'])->name('seemCommissions.deleteAttachment');
            Route::get('/seemCommissions/show/{id}', [SeemCommissionController::class, 'show'])->name('seemCommissions.show');
            Route::get('/seemCommissions/{id}/edit', [SeemCommissionController::class, 'edit'])->name('seemCommissions.edit');
            Route::get('/seemCommissions/create', [SeemCommissionController::class, 'create'])->name('seemCommissions.create');
            Route::get('/seemCommissions/{id}', [SeemCommissionController::class, 'destroy'])->name('seemCommissions.destroy');
            Route::post('/seemCommissions', [SeemCommissionController::class, 'store'])->name('seemCommissions.store');
            Route::get('/seemCommissions', [SeemCommissionController::class, 'index'])->name('seemCommissions.index');


            //Rotas de proposituras             
            //Route::any('/propositions/search', [PropositionController::class, 'search'])->name('propositions.search');
            Route::get('/propositions', [PropositionController::class, 'index'])->name('propositions.index');
            Route::put('/propositions/{id}', [PropositionController::class, 'update'])->name('propositions.update');
            Route::get('/propositions/deleteAttachment/{id}', [PropositionController::class, 'deleteAttachment'])->name('propositions.deleteAttachment');
            Route::get('/propositions/show/{id}', [PropositionController::class, 'show'])->name('propositions.show');
            Route::get('/propositions/{id}/edit', [PropositionController::class, 'edit'])->name('propositions.edit');
            Route::get('/propositions/create', [PropositionController::class, 'create'])->name('propositions.create');
            Route::get('/propositions/{id}', [PropositionController::class, 'destroy'])->name('propositions.destroy');
            Route::post('/propositions', [PropositionController::class, 'store'])->name('propositions.store');

            //Rotas de pronunciamentos  
             Route::any('/pronunciamentos/search', [PronunciamentoController::class, 'search'])->name('pronunciamentos.search');
             Route::get('/pronunciamentos', [PronunciamentoController::class, 'index'])->name('pronunciamentos.index');
             Route::put('/pronunciamentos/{id}', [PronunciamentoController::class, 'update'])->name('pronunciamentos.update');
             Route::get('/pronunciamentos/show/{id}', [PronunciamentoController::class, 'show'])->name('pronunciamentos.show');
             Route::get('/pronunciamentos/{id}/edit', [PronunciamentoController::class, 'edit'])->name('pronunciamentos.edit');
             Route::get('/pronunciamentos/create', [PronunciamentoController::class, 'create'])->name('pronunciamentos.create');
             Route::get('/pronunciamentos/{id}', [PronunciamentoController::class, 'destroy'])->name('pronunciamentos.destroy');
             Route::post('/pronunciamentos', [PronunciamentoController::class, 'store'])->name('pronunciamentos.store');
 
            Route::get('/propositions/{id}/votoCreate', [PropositionController::class, 'createVotoCouncilor'])->name('propositionVotoCreate.create');
            Route::post('/propositions/{id}/votoStore', [PropositionController::class, 'storeVotoCouncilor'])->name('storeVotoCouncilor.store');
            Route::get('/propositions/{id}/votoEdit', [PropositionController::class, 'editVotoCouncilor'])->name('propositionVotoEdit.edit');
            Route::put('/propositions/{id}/votoUpdate', [PropositionController::class, 'updateVotoCouncilor'])->name('propositionVotoUpdate.update');
            Route::get('/propositions/vereadores/{id?}', [PropositionController::class, 'vereadoresSessao'])->name('vereadoresSessao.get'); //recupera os vereadores sessao->lesgislatura selecionada



            //Rotas de Atas             
            Route::any('/minutes/search', [MinuteController::class, 'search'])->name('minutes.search');
            Route::put('/minutes/{id}', [MinuteController::class, 'update'])->name('minutes.update');
            Route::get('/minutes/deleteAttachment/{id}', [MinuteController::class, 'deleteAttachment'])->name('minutes.deleteAttachment');
            Route::get('/minutes/show/{id}', [MinuteController::class, 'show'])->name('minutes.show');
            Route::get('/minutes/{id}/edit', [MinuteController::class, 'edit'])->name('minutes.edit');
            Route::get('/minutes/create', [MinuteController::class, 'create'])->name('minutes.create');
            Route::get('/minutes/{id}', [MinuteController::class, 'destroy'])->name('minutes.destroy');
            Route::post('/minutes', [MinuteController::class, 'store'])->name('minutes.store');
            Route::get('/minutes', [MinuteController::class, 'index'])->name('minutes.index');



            //Rotas de Mesa Diretora x Membros
            Route::get('/directorTables/members/{id}', [DirectorTableController::class, 'membersDestroy'])->name('directorTablesDestroy.destroy');
            Route::post('/directorTables/{id}/members', [DirectorTableController::class, 'membersStore'])->name('directorTablesStore.store');
            Route::get('/directorTables/{id}/members/create', [DirectorTableController::class, 'membersCreate'])->name('directorTablesCreate.create');
            Route::get('/directorTables/{id}/members', [DirectorTableController::class, 'members'])->name('directorTableMembers.index');


            //Rotas de Mesa Diretora             
            Route::any('/directorTables/search', [DirectorTableController::class, 'search'])->name('directorTables.search');
            Route::put('/directorTables/{id}', [DirectorTableController::class, 'update'])->name('directorTables.update');
            Route::get('/directorTables/{id}/edit', [DirectorTableController::class, 'edit'])->name('directorTables.edit');
            Route::get('/directorTables/create', [DirectorTableController::class, 'create'])->name('directorTables.create');
            Route::get('/directorTables/{id}', [DirectorTableController::class, 'destroy'])->name('directorTables.destroy');
            Route::post('/directorTables', [DirectorTableController::class, 'store'])->name('directorTables.store');
            Route::get('/directorTables', [DirectorTableController::class, 'index'])->name('directorTables.index');



            //Rotas de Comissões x membros
            Route::get('/commissions/members/{id}', [CommissionController::class, 'membersDestroy'])->name('comissionMembersDestroy.destroy');
            Route::post('/commissions/{id}/members', [CommissionController::class, 'membersStore'])->name('comissionMembersStore.store');
            Route::get('/commissions/{id}/members/create', [CommissionController::class, 'membersCreate'])->name('comissionMembersCreate.create');
            Route::get('/commissions/{id}/members', [CommissionController::class, 'members'])->name('comissionMembers.index');

            //Rotas de Comissões             
            Route::any('/commissions/search', [CommissionController::class, 'search'])->name('commissions.search');
            Route::put('/commissions/{id}', [CommissionController::class, 'update'])->name('commissions.update');
            Route::get('/commissions/{id}/edit', [CommissionController::class, 'edit'])->name('commissions.edit');
            Route::get('/commissions/create', [CommissionController::class, 'create'])->name('commissions.create');
            Route::get('/commissions/{id}', [CommissionController::class, 'destroy'])->name('commissions.destroy');
            Route::post('/commissions', [CommissionController::class, 'store'])->name('commissions.store');
            Route::get('/commissions', [CommissionController::class, 'index'])->name('commissions.index');



            //Rotas de Funções             
            Route::any('/functions/search', [FunctionController::class, 'search'])->name('functions.search');
            Route::put('/functions/{id}', [FunctionController::class, 'update'])->name('functions.update');
            Route::get('/functions/{id}/edit', [FunctionController::class, 'edit'])->name('functions.edit');
            Route::get('/functions/create', [FunctionController::class, 'create'])->name('functions.create');
            Route::get('/functions/{id}', [FunctionController::class, 'destroy'])->name('functions.destroy');
            Route::post('/functions', [FunctionController::class, 'store'])->name('functions.store');
            Route::get('/functions', [FunctionController::class, 'index'])->name('functions.index');

            //Rotas de User x Functions            
            Route::any('/userFunctions/search', [UserFunctionController::class, 'search'])->name('userFunctions.search');
            Route::put('/userFunctions/{id}', [UserFunctionController::class, 'update'])->name('userFunctions.update');
            Route::get('/userFunctions/{id}/edit', [UserFunctionController::class, 'edit'])->name('userFunctions.edit');
            Route::get('/userFunctions/create', [UserFunctionController::class, 'create'])->name('userFunctions.create');
            Route::get('/userFunctions/{id}', [UserFunctionController::class, 'destroy'])->name('userFunctions.destroy');
            Route::post('/userFunctions', [UserFunctionController::class, 'store'])->name('userFunctions.store');
            Route::get('/userFunctions', [UserFunctionController::class, 'index'])->name('userFunctions.index');


            //Rotas de Partidos
            Route::any('/parties/search', [PartyController::class, 'search'])->name('parties.search');
            Route::put('/parties/{id}', [PartyController::class, 'update'])->name('parties.update');
            Route::get('/parties/{id}/edit', [PartyController::class, 'edit'])->name('parties.edit');
            Route::get('/parties/create', [PartyController::class, 'create'])->name('parties.create');
            Route::get('/parties/{id}', [PartyController::class, 'destroy'])->name('parties.destroy');
            Route::post('/parties', [PartyController::class, 'store'])->name('parties.store');
            Route::get('/parties', [PartyController::class, 'index'])->name('parties.index');



            //Rotas de Posts
            Route::any('/posts/search', [PostController::class, 'search'])->name('posts.search');
            Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
            Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
            Route::get('/posts/deleteImage/{id}', [PostController::class, 'removeImage'])->name('posts.deleteImage');
            Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('posts.show');
            Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
            Route::get('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
            Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
            Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

            //Rotas de Popups
            Route::any('/popups/search', [PopupsController::class, 'search'])->name('popups.search');
            Route::put('/popups/{id}', [PopupsController::class, 'update'])->name('popups.update');
            Route::get('/popups/{id}/edit', [PopupsController::class, 'edit'])->name('popups.edit');
            Route::get('/popups/deleteImage/{id}', [PopupsController::class, 'removeImage'])->name('popups.deleteImage');
            Route::get('/popups/show/{id}', [PopupsController::class, 'show'])->name('popups.show');
            Route::get('/popups/create', [PopupsController::class, 'create'])->name('popups.create');
            Route::get('/popups/{id}', [PopupsController::class, 'destroy'])->name('popups.destroy');
            Route::post('/popups', [PopupsController::class, 'store'])->name('popups.store');
            Route::get('/popups', [PopupsController::class, 'index'])->name('popups.index');

            //Rotas de Enquetes
            
            Route::any('/enquetes/search', [EnqueteController::class, 'search'])->name('enquetes.search');
            Route::put('/enquetes/{id}', [EnqueteController::class, 'update'])->name('enquetes.update');
            Route::get('/enquetes/{id}/edit', [EnqueteController::class, 'edit'])->name('enquetes.edit');            
            Route::get('/enquetes/create', [EnqueteController::class, 'create'])->name('enquetes.create');
            Route::get('/enquetes/{id}', [EnqueteController::class, 'destroy'])->name('enquetes.destroy'); 
            Route::get('/enquetes', [EnqueteController::class, 'index'])->name('enquetes.index');           
            Route::post('/enquetes', [EnqueteController::class, 'store'])->name('enquetes.store');
            

            
            
            Route::put('/enquetes/item/{id}', [EnqueteController::class, 'updateItem'])->name('enquetes.updateItem');
            Route::get('/enquetes/item/{id}/editItem', [EnqueteController::class, 'editItem'])->name('enquetes.editItem');
            Route::get('/enquetes/item/{id}/createItem', [EnqueteController::class, 'createItem'])->name('enquetes.createItem');
            Route::get('/enquetes/item/{id}', [EnqueteController::class, 'destroyItem'])->name('enquetes.destroyItem');
            Route::post('/enquetes/item', [EnqueteController::class, 'storeItem'])->name('enquetes.storeItem');
            


            //Rotas de Carta ao cidadão
            Route::put('/citizenLetters/{id}', [CitizenLetterController::class, 'update'])->name('citizenLetters.update');
            Route::get('/citizenLetters/{id}/edit', [CitizenLetterController::class, 'edit'])->name('citizenLetters.edit');
            Route::get('/citizenLetters/show/{id}', [CitizenLetterController::class, 'show'])->name('citizenLetters.show');
            Route::get('/citizenLetters/create', [CitizenLetterController::class, 'create'])->name('citizenLetters.create');
            Route::get('/citizenLetters/{id}', [CitizenLetterController::class, 'destroy'])->name('citizenLetters.destroy');
            Route::post('/citizenLetters', [CitizenLetterController::class, 'store'])->name('citizenLetters.store');
            Route::get('/citizenLetters', [CitizenLetterController::class, 'index'])->name('citizenLetters.index');



            //Rotas de Secretarias
            Route::any('/secretaries/search', [SecretaryController::class, 'search'])->name('secretaries.search');
            Route::put('/secretaries/{id}', [SecretaryController::class, 'update'])->name('secretaries.update');
            Route::get('/secretaries/{id}/edit', [SecretaryController::class, 'edit'])->name('secretaries.edit');
            Route::get('/secretaries/show/{id}', [SecretaryController::class, 'show'])->name('secretaries.show');
            Route::get('/secretaries/create', [SecretaryController::class, 'create'])->name('secretaries.create');
            Route::get('/secretaries/{id}', [SecretaryController::class, 'destroy'])->name('secretaries.destroy');
            Route::post('/secretaries', [SecretaryController::class, 'store'])->name('secretaries.store');
            Route::get('/secretaries', [SecretaryController::class, 'index'])->name('secretaries.index');

            // //Rotas de Setores
            Route::any('/setores/search', [SetoresController::class, 'search'])->name('setores.search');
            Route::put('/setores/{id}', [SetoresController::class, 'update'])->name('setores.update');
            Route::get('/setores/{id}/edit', [SetoresController::class, 'edit'])->name('setores.edit');
            Route::get('/setores/show/{id}', [SetoresController::class, 'show'])->name('setores.show');
            Route::get('/setores/create', [SetoresController::class, 'create'])->name('setores.create');
            Route::get('/setores/{id}', [SetoresController::class, 'destroy'])->name('setores.destroy');
            Route::post('/setores', [SetoresController::class, 'store'])->name('setores.store');
            Route::get('/setores', [SetoresController::class, 'index'])->name('setores.index');


            //Rotas de Planos
            Route::any('/plans/search', [PlanController::class, 'search'])->name('plans.search');
            Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update');
            Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit');
            Route::get('/plans/show/{id}', [PlanController::class, 'show'])->name('plans.show');
            Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
            Route::get('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
            Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
            Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');

            //Rotas de Planos X perfil        
            Route::get('plans/{id}/profiles/{idProfile}/detach', [PlanProfileController::class, 'detachProfilesPlan'])->name('plans.profiles.detach');
            Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlans'])->name('plans.profiles.attach');
            Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
            Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');


            //Rotas de Usuários
            Route::get('/users/{id}/profiles', [UserController::class, 'profiles'])->name('user.profiles');
            Route::any('/users/search', [UserController::class, 'search'])->name('users.search');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

            Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users', [UserController::class, 'index'])->name('users.index');

            //Rotas para o usuário ver e manipular seu próprio perfil
            Route::get('/users/perfil/{id}', [DadosPessoasController::class, 'index'])->name('users.perfil');
            Route::post('/users/perfil/{id}', [DadosPessoasController::class, 'store'])->name('users.perfil.store');
            Route::post('/users/perfil/', [DadosPessoasController::class, 'storeDocumento'])->name('users.perfil.storeDocumentos');
            Route::get('/users/attachmentDelete/{id}', [DadosPessoasController::class, 'deleteAttachment'])->name('users.perfil.deleteAttachment');


            Route::any('/fornecedores', [DadosPessoasController::class, 'fornecedores'])->name('fornecedores.index');          
            Route::get('/fornecedores/show/{id}', [DadosPessoasController::class, 'fornecedorShow'])->name('fornecedores.show');

            //Rotas de Permissões
            Route::any('/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
            Route::put('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
            Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
            Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
            Route::get('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
            Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
            Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');


            //Rotas de Perfis
            Route::any('/profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
            Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
            Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
            Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
            Route::get('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
            Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
            Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');

            //Rotas de Permmissão X perfil
            Route::get('profile/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permissions.detach');
            Route::post('profile/{id}/permissions', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profile.permissions.attach');
            Route::any('profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
            Route::any('profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
            Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
            Route::get('permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');


            //Rotas de Perfil X usuários
            Route::get('profile/{id}/users/{idUser}/detach', [ProfileUserController::class, 'detachProfileUser'])->name('profile.users.detach');
            Route::post('profile/{id}/users', [ProfileUserController::class, 'attachProfileUser'])->name('profile.users.attach');
            Route::any('profile/{id}/users/create', [ProfileUserController::class, 'usersAvailable'])->name('profile.users.available');
            Route::get('profiles/{id}/users', [ProfileUserController::class, 'users'])->name('profiles.users');
            Route::get('users/{id}/profile', [ProfileUserController::class, 'profiles'])->name('');



            //Rotas de Categorias
            Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
            Route::get('/categorias/{url}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
            Route::any('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
            Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
            Route::get('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
            Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
            Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

            //Rotas de Ouvidoria             
            Route::get('/configuracao/ouvidoria', [ConfiguracaoOuvidoriaController::class, 'index'])->name('ouvidoria.configuracao.index');
            Route::put('/configuracao/ouvidoria/{id}', [ConfiguracaoOuvidoriaController::class, 'update'])->name('ouvidoria.configuracao.update');
            Route::get('/configuracao/ouvidoria/{id}/edit', [ConfiguracaoOuvidoriaController::class, 'edit'])->name('ouvidoria.configuracao.edit');
            Route::get('/configuracao/ouvidoria/create', [ConfiguracaoOuvidoriaController::class, 'create'])->name('ouvidoria.configuracao.create');
            Route::post('/configuracao/ouvidoria', [ConfiguracaoOuvidoriaController::class, 'store'])->name('ouvidoria.configuracao.store');

            Route::any('/ouvidorias/search', [OuvidoriaController::class, 'search'])->name('ouvidorias.search');
            Route::put('/ouvidorias/{id}', [OuvidoriaController::class, 'update'])->name('ouvidorias.update');
            Route::get('/ouvidorias/show/{id}', [OuvidoriaController::class, 'show'])->name('ouvidorias.show');
            Route::get('/ouvidorias/{id}/edit', [OuvidoriaController::class, 'edit'])->name('ouvidorias.edit');
            Route::get('/ouvidorias/create', [OuvidoriaController::class, 'create'])->name('ouvidorias.create');
            Route::get('/ouvidorias/{id}', [OuvidoriaController::class, 'destroy'])->name('ouvidorias.destroy');
            Route::post('/ouvidorias', [OuvidoriaController::class, 'store'])->name('ouvidorias.store');
            Route::get('/ouvidorias', [OuvidoriaController::class, 'index'])->name('ouvidorias.index');

            //Rotas de Agenda 
            Route::get('/agenda', [ScheduleController::class, 'index'])->name('schedule.index');
            Route::post('/agenda', [ScheduleController::class, 'store'])->name('schedule.index');
            Route::get('/agenda/show', [ScheduleController::class, 'show'])->name('schedule.index');
            Route::delete('/agenda/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
            Route::put('/agenda/{id}', [ScheduleController::class, 'update'])->name('schedule.update');

            // Perguntas
            Route::get('/pesquisas', [PerguntaPesquisaController::class, 'index'])->name('pesquisa.index');
            Route::get('/pesquisa/{questionario}/perguntas', [PerguntaPesquisaController::class, 'perguntas'])
            ->name('perguntas.index');
            Route::get('/perguntas/{questionario_id}/create', [PerguntaPesquisaController::class, 'create'])->name('perguntas.create');
                        Route::post('/perguntas', [PerguntaPesquisaController::class, 'store'])->name('perguntas.store');
            Route::get('/perguntas/{id}/edit', [PerguntaPesquisaController::class, 'edit'])->name('perguntas.edit');
            Route::put('/perguntas/{id}', [PerguntaPesquisaController::class, 'update'])->name('perguntas.update');
            Route::get('/perguntas/{id}', [PerguntaPesquisaController::class, 'destroy'])->name('perguntas.destroy');

          

            // Suas rotas protegidas so acessa se o cadastro estiver completo
            Route::middleware(['auth', 'profile.complete'])->group(function () {
                //Rotas de Processos                   
                Route::any('/processos/search', [ProcessoCompraController::class, 'search'])->name('processos.search');
                Route::put('/processos/{id}', [ProcessoCompraController::class, 'update'])->name('processos.update');
                Route::get('/processos/{id}/edit', [ProcessoCompraController::class, 'edit'])->name('processos.edit');
                Route::get('/processos/show/{id}', [ProcessoCompraController::class, 'show'])->name('processos.show');
                Route::get('/processos/create/', [ProcessoCompraController::class, 'create'])->name('processos.create');
                Route::get('/processos/{id}', [ProcessoCompraController::class, 'destroy'])->name('processos.destroy');
                Route::get('/processos/{id}/attachmentCreate', [ProcessoCompraController::class, 'createAttachment'])->name('processoAttachmentCreate.create');
                Route::post('/processos/attachmentStore', [ProcessoCompraController::class, 'storeAttachment'])->name('processoAttachmentStore.store');
                Route::get('/processos/attachmentDelete/{id}', [ProcessoCompraController::class, 'deleteAttachment'])->name('processoAttachmentDelete.delete');
                Route::post('/processos', [ProcessoCompraController::class, 'store'])->name('processos.store');
                Route::get('/processos', [ProcessoCompraController::class, 'index'])->name('processos.index');
                Route::get('/processos/{id}/credenciados', [ProcessoCompraController::class, 'verCrendenciados'])->name('processos.credenciados');
                Route::get('/processos/ata/{id}', [ProcessoCompraController::class, 'ata'])->name('processos.ata');
                Route::get('/processos/credeciamentosDetalhado/{id}', [ProcessoCompraController::class, 'credeciamentosDetalhado'])->name('processos.credeciamentosDetalhado');
                Route::post('/gerar-pdf',[ProcessoCompraController::class, 'gerarPdf'])->name('gerar.pdf');
                
                //Rotas de Credenciamento
                Route::delete('/processos/credenciamento/{id}', [CredenciamentoProcessoComprasController::class, 'deleteDocumentoCredenciamento'])->name('credenciamento.deleteDocumentoCredenciamento');
                Route::post('/processos/credenciamento', [CredenciamentoProcessoComprasController::class, 'storeDocumentoCredenciamento'])->name('credenciamento.store.documento');
                Route::get('/processos/credenciamento/{credenciamento_compra_id}/documentos', [CredenciamentoProcessoComprasController::class, 'getUploadedDocuments'])->name('credenciamento.get.documentos');

                Route::get('/processos/{id}/credenciamento', [CredenciamentoProcessoComprasController::class, 'create'])->name('credenciamento.create');
                Route::get('/processos/credenciamento/{credenciamento_compra_id}/{movimentacao_id?}', [CredenciamentoProcessoComprasController::class, 'store'])->name('credenciamento.store');
                Route::get('/processos/credenciados/{credenciamento_compra_id}', [CredenciamentoProcessoComprasController::class, 'receberCredenciamento'])->name('credenciamento.receberCredenciamento');
                Route::post('/processos/credenciados', [CredenciamentoProcessoComprasController::class, 'movimentarCredenciamento'])->name('credenciamento.movimentarCredenciamento');
                Route::get('/processos/{processo_id}/credenciados/complemetacao/{credenciamento_compra_id}', [CredenciamentoProcessoComprasController::class, 'createEnviarComplementacao'])->name('credenciamento.createEnviarComplementacao');
                Route::get('/processos/credeciados/timeline/{credenciamento_compra_id}', [CredenciamentoProcessoComprasController::class, 'showTimeline'])->name('credenciamento.showTimeline');

            });




            //Rotas de Diario oficial
            Route::prefix('diario')
                ->namespace('diario')
                ->group(function () {
                    //Rotas de Tipo de Materias
                    Route::any('/tipoMaterias/search', [TipoMateriaController::class, 'search'])->name('tipoMaterias.search');
                    Route::put('/tipoMaterias/{id}', [TipoMateriaController::class, 'update'])->name('tipoMaterias.update');
                    Route::get('/tipoMaterias/{id}/edit', [TipoMateriaController::class, 'edit'])->name('tipoMaterias.edit');
                    Route::get('/tipoMaterias/show/{id}', [TipoMateriaController::class, 'show'])->name('tipoMaterias.show');
                    Route::get('/tipoMaterias/create', [TipoMateriaController::class, 'create'])->name('tipoMaterias.create');
                    Route::get('/tipoMaterias/{id}', [TipoMateriaController::class, 'destroy'])->name('tipoMaterias.destroy');
                    Route::post('/tipoMaterias', [TipoMateriaController::class, 'store'])->name('tipoMaterias.store');
                    Route::get('/tipoMaterias', [TipoMateriaController::class, 'index'])->name('tipoMaterias.index');

                    //Rotas de Tipo de Materias
                    Route::any('/subTipoMateria/search', [SubTipoMateriaController::class, 'search'])->name('subTipoMaterias.search');
                    Route::put('/subTipoMateria/{id}', [SubTipoMateriaController::class, 'update'])->name('subTipoMaterias.update');
                    Route::get('/subTipoMateria/{id}/edit', [SubTipoMateriaController::class, 'edit'])->name('subTipoMaterias.edit');
                    Route::get('/subTipoMateria/show/{id}', [SubTipoMateriaController::class, 'show'])->name('subTipoMaterias.show');
                    Route::get('/subTipoMateria/create', [SubTipoMateriaController::class, 'create'])->name('subTipoMaterias.create');
                    Route::get('/subTipoMateria/{id}', [SubTipoMateriaController::class, 'destroy'])->name('subTipoMaterias.destroy');
                    Route::post('/subTipoMateria', [SubTipoMateriaController::class, 'store'])->name('subTipoMaterias.store');
                    Route::get('/subTipoMateria', [SubTipoMateriaController::class, 'index'])->name('subTipoMaterias.index');
                
                 
                    //Rotas docmentos Dof
                    Route::any('/documentos/search', [DocumentoDofController::class, 'search'])->name('documentos.search');
                    Route::put('/documentos/{id}', [DocumentoDofController::class, 'update'])->name('documentos.update');
                    Route::get('/documentos/{id}/edit', [DocumentoDofController::class, 'edit'])->name('documentos.edit');
                    Route::get('/documentos/show/{id}', [DocumentoDofController::class, 'show'])->name('documentos.show');
                    Route::get('/documentos/create', [DocumentoDofController::class, 'create'])->name('documentos.create');
                    Route::get('/documentos/{id}', [DocumentoDofController::class, 'destroy'])->name('documentos.destroy');
                    Route::post('/documentos', [DocumentoDofController::class, 'store'])->name('documentos.store');
                    Route::get('/documentos', [DocumentoDofController::class, 'index'])->name('documentos.index');
                    Route::get('/subtipos/{tipo_materia_id}', [DocumentoDofController::class, 'getSubTiposByTipo'])->name('get.subtipos');
                    Route::get('/documentos/getFunctions', [DocumentoDofController::class, 'getFunctions'])->name('get.functions');
                    Route::get('/documentos/get-functions/user', [DocumentoDofController::class, 'getFunctions'])->name('get.functions');
                                     
                    Route::post('/documentos/show/{uuid}/sign', [DocumentoDofController::class, 'signDocument'])->name('documentos.sign');
                    



                });
        });
});

//Route::prefix('/')->group(base_path('routes/legislativo.php'));
Route::prefix('/')->group(base_path('routes/site.php'));
//Route::prefix('/')->group(base_path('routes/executivo.php'));
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.index');
*/


Route::get('/verificador/{codigoVerificacao}', [DocumentoDofController::class, 'verificarDocumento'])->name('verificador');
//Rotas de ouvidoria do site

// Route::get('/ouvidoria/acompanhamento', [OuvidoriaSiteController::class, 'acompanhamento'])->name('ouvidoria.acompanhamento');
// Route::get('/ouvidoria/create/{tipo}', [OuvidoriaSiteController::class, 'create'])->name('ouvidoria.create');
// Route::post('/ouvidoria', [OuvidoriaSiteController::class, 'store'])->name('ouvidoria.store');
// Route::get('/ouvidoria/confirmacao', [OuvidoriaSiteController::class, 'confirmacao'])->name('ouvidoria.confirmacao');
// Route::get('/ouvidoria', [OuvidoriaSiteController::class, 'index'])->name('ouvidoriaSite.index');
// Route::get('/ouvidoria/duvidas', [OuvidoriaSiteController::class, 'duvidas'])->name('ouvidoriaSite.duvidas');

//Rotas Comuns do site
// Route::get('/pagina/{slug}', [SiteController::class, 'page'])->name('pagina');
//Route::get('/acessibilidade', [SiteController::class, 'acessibilidade'])->name('site.acessibilidade');
//Route::get('/sitemap', [SiteController::class, 'mapasite'])->name('site.mapa');
//Route::get('/pesquisar', [SiteController::class, 'pesquisar'])->name('site.pesquisar');

Route::post('contato/', [SiteController::class, 'contato'])->name('contato.enviar');
Route::get('compras/procesos', [SiteController::class, 'processosComprasIndex'])->name('processoCompras.index');
Route::get('/publicacoes/dof', [SiteController::class, 'dof'])->name('publicacoes.dof');
Route::get('/publicacoes/dof/{uuid}', [SiteController::class, 'dofVerDocumento'])->name('publicacoes.dofVerDocumento');
//Rota para fazer a contagem de Download dos anexos dos processos de compras
Route::get('/processos/download/{id}', [ProcessoCompraController::class, 'download'])->name('download.count');


Route::post('/enquete/votar/{id}', [SiteController::class, 'votar'])->name('enquete.votar');
Route::get('/enquete/resultado/{id}', [SiteController::class, 'resultadoEnquete'])->name('enquete.resultado');




// Rotas principais (já devem existir)
//Route::get('/', [SitePublicoController::class, 'index'])->name('site.index');
// Route::get('/noticias', [SitePublicoController::class, 'noticias'])->name('site.noticias.todas');
//Route::get('/noticia/{url}', [SitePublicoController::class, 'noticiaShow'])->name('noticias.show');
//Route::get('/agenda', [SitePublicoController::class, 'agenda'])->name('site.agenda');
Route::get('/pesquisar/site', [SitePublicoController::class, 'pesquisar'])->name('site.pesquisar');


// Rotas adicionais (adicione se não existirem)
Route::get('/acessibilidade', function() {
    return view('public_templates.' . view()->shared('currentTemplate') . '.includes.acessibilidade');
})->name('site.acessibilidade');

Route::get('/sitemap', function() {
    return view('public_templates.' . view()->shared('currentTemplate') . '.includes.sitemap');
})->name('site.sitemap');

// Rotas futuras (opcional - adicione quando implementar)


Route::get('/decretos', function() {
    return view('public_templates.' . view()->shared('currentTemplate') . '.includes.decretos.index');
})->name('site.decretos');

require __DIR__ . '/auth.php';
