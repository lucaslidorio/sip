<?php


use App\Http\Controllers\Admin\CommissionMemberFunction;
use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\CitizenLetterController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\CouncilorController;
use App\Http\Controllers\Admin\DirectorTableController;
use App\Http\Controllers\Admin\FunctionController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LegislationController;
use App\Http\Controllers\Admin\LegislatureController;
use App\Http\Controllers\Admin\MinuteController;
use App\Http\Controllers\Admin\OuvidoriaController;
use App\Http\Controllers\Admin\PartyController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PropositionController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\SeemCommissionController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AtaController;
use App\Http\Controllers\Site\OuvidoriaSiteController;
use App\Http\Controllers\Site\SiteController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;

//Grupo de roda para Middleware de autenticação
Route::middleware(['auth'])->group(function () {

    //Rota da dashboard (home) 
    Route::get('home', [HomeController::class ,'index'])->name('dashboard.index');
 
    Route::prefix('admin')
            ->namespace('Admin')                
            ->group(function () {
               
                
                Route::prefix('legislativo')
                    ->namespace('Legislativo')
                    ->group(function(){                      
                  

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

            //Rotas de orgãos
            Route::any('/tenants/search', [TenantController::class, 'search'])->name('tenants.search');
            Route::put('/tenants/{id}', [TenantController::class, 'update'])->name('tenants.update');
            Route::get('/tenants/{id}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
            Route::get('/tenants/show/{id}', [TenantController::class, 'show'])->name('tenants.show');
            Route::get('/tenants/create', [TenantController::class, 'create'])->name('tenants.create');
            Route::get('/tenants/{id}', [TenantController::class, 'destroy'])->name('tenants.destroy');
            Route::post('/tenants', [TenantController::class, 'store'])->name('tenants.store');
            Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');

            
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
            Route::get( 'plans/{id}/profiles/{idProfile}/detach', [PlanProfileController::class, 'detachProfilesPlan'])->name('plans.profiles.detach');
            Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlans'])->name('plans.profiles.attach');
            Route::any( 'plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
            Route::get( 'plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');


            //Rotas de Usuários
            Route::any('/users/search', [UserController::class, 'search'])->name('users.search');
            Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
            Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::get('/users/show/{id}', [UserController::class, 'show'])->name('users.show');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::get('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            

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
            Route::get( 'profile/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permissions.detach');
            Route::post('profile/{id}/permissions', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profile.permissions.attach');
            Route::any( 'profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
            Route::get( 'profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
            Route::get( 'permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');



            //Rotas de Categorias
            Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
            Route::get('/categorias/{url}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
            Route::any('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
            Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
            Route::get('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
            Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
            Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

            //Rotas de Ouvidoria             
            Route::any('/ouvidorias/search', [OuvidoriaController::class, 'search'])->name('ouvidorias.search');
            Route::put('/ouvidorias/{id}', [OuvidoriaController::class, 'update'])->name('ouvidorias.update');          
            Route::get('/ouvidorias/show/{id}', [OuvidoriaController::class, 'show'])->name('ouvidorias.show');
            Route::get('/ouvidorias/{id}/edit', [OuvidoriaController::class, 'edit'])->name('ouvidorias.edit');
            Route::get('/ouvidorias/create', [OuvidoriaController::class, 'create'])->name('ouvidorias.create');
            Route::get('/ouvidorias/{id}', [OuvidoriaController::class, 'destroy'])->name('ouvidorias.destroy');
            Route::post('/ouvidorias', [OuvidoriaController::class, 'store'])->name('ouvidorias.store');
            Route::get('/ouvidorias', [OuvidoriaController::class, 'index'])->name('ouvidorias.index');

            

        
    });

});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.index');
*/

Route::get('/', [SiteController::class, 'index'])->name('site.home');

Route::get('noticias/todas', [SiteController::class, 'noticiasTodas'])->name('noticias.todas');
Route::any('noticias/pesquisar', [SiteController::class, 'noticiasTodasPesquisar'])->name('noticiasTodas.pesquisar');
Route::get('noticias/{url}', [SiteController::class, 'noticiaShow'])->name('noticias.show');
Route::get('vereadores/{nome}', [SiteController::class, 'vereadoresShow'])->name('vereadores.show');
Route::get('sessoes', [SiteController::class, 'sessoesIndex'])->name('sessoes.index');
Route::get('sessoes/{nome}', [SiteController::class, 'sessoesShow'])->name('sessões.show');
Route::get('documentos-sessoes/', [SiteController::class, 'documentosSessoesPesquisar'])->name('documentosSessoes.pesquisar');
Route::get('proposituras/', [SiteController::class, 'proposituraPesquisar'])->name('proposituraPesquisar.pesquisar');
Route::get('proposituras/{id}', [SiteController::class, 'proposituraShow'])->name('propositura.show');
Route::get('carta-cidadao/{id}', [SiteController::class, 'cartaCidadaoShow'])->name('cartaCidadao.show');
Route::get('legislacoes', [SiteController::class, 'legislacoes'])->name('legislacoes.index');
Route::get('legislacoes/{id}', [SiteController::class, 'legislacaoShow'])->name('legislacao.show');
Route::get('pareceres', [SiteController::class, 'parecerPesquisar'])->name('parecer.pesquisar');
Route::get('pareceres/{id}', [SiteController::class, 'parecerShow'])->name('parecer.show');

//Rotas de ouvidoria do site

Route::get('/ouvidoria/acompanhamento', [OuvidoriaSiteController::class, 'acompanhamento'])->name('ouvidoria.acompanhamento');
Route::get('/ouvidoria/create/{tipo}', [OuvidoriaSiteController::class, 'create'])->name('ouvidoria.create');
Route::post('/ouvidoria', [OuvidoriaSiteController::class, 'store'])->name('ouvidoria.store');
Route::get('/ouvidoria/confirmacao', [OuvidoriaSiteController::class, 'confirmacao'])->name('ouvidoria.confirmacao');
Route::get('/ouvidoria', [OuvidoriaSiteController::class, 'index'])->name('ouvidoriaSite.index');
Route::get('/ouvidoria/duvidas', [OuvidoriaSiteController::class, 'duvidas'])->name('ouvidoriaSite.duvidas');
            

Route::post('contato/', [SiteController::class, 'contato'])->name('contato.enviar');
// Route::get('/', function () {
//     //Alert::success('Success Title', 'Success Message');
//     //toast('Success Toast','success');

//     return view('site/index');
// });



require __DIR__.'/auth.php';