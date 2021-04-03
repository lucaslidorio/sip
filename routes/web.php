<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PartyController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Grupo de roda para Middleware de autenticação
Route::middleware(['auth'])->group(function () {

    //Rota da dashboard (home)
      Route::get('home', [HomeController::class ,'index'])->name('dashboard.index');
    //Rotas de Permmissão X perfil
    Route::get( 'profile/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permissions.detach');
    Route::post('profile/{id}/permissions', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profile.permissions.attach');
    Route::any( 'profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
    Route::get( 'profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get( 'permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');


    Route::prefix('admin')
            ->namespace('Admin')                
            ->group(function () {

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
                 

            
            //Rotas de Secretarias
            Route::any('/secretaries/search', [SecretaryController::class, 'search'])->name('secretaries.search');
            Route::put('/secretaries/{id}', [SecretaryController::class, 'update'])->name('secretaries.update');
            Route::get('/secretaries/{id}/edit', [SecretaryController::class, 'edit'])->name('secretaries.edit');
            Route::get('/secretaries/show/{id}', [SecretaryController::class, 'show'])->name('secretaries.show');
            Route::get('/secretaries/create', [SecretaryController::class, 'create'])->name('secretaries.create');
            Route::get('/secretaries/{id}', [SecretaryController::class, 'destroy'])->name('secretaries.destroy');
            Route::post('/secretaries', [SecretaryController::class, 'store'])->name('secretaries.store');
            Route::get('/secretaries', [SecretaryController::class, 'index'])->name('secretaries.index');
            


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


            //Rotas de Categorias
            Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
            Route::get('/categorias/{url}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
            Route::any('/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
            Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
            Route::get('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
            Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
            Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

        
    });

});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.index');
*/

Route::get('/', function () {
    //Alert::success('Success Title', 'Success Message');
    //toast('Success Toast','success');

    return view('site/index');
});



require __DIR__.'/auth.php';