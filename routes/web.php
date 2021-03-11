<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\CategoriaController;

use Illuminate\Support\Facades\Route;
//Rota do Dashboard
Route::get('admin/', [CategoriaController::class, 'index'])->name('admin.index');

//Rotas de Permmissão X perfil
Route::get( 'profile/{id}/permission/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profile.permissions.detach');
Route::post( 'profile/{id}/permissions', [PermissionProfileController::class, 'attachPermissionProfile'])->name('profile.permissions.attach');
Route::any( 'profile/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profile.permissions.available');
Route::get( 'profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
Route::get( 'permissions/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');


//Rotas de Permissões
Route::any('admin/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
Route::put('admin/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
Route::get('admin/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
Route::get('admin/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
Route::post('admin/permissions', [PermissionController::class, 'store'])->name('permissions.store');
Route::get('admin/permissions', [PermissionController::class, 'index'])->name('permissions.index');


//Rotas de Perfis
Route::any('admin/profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
Route::put('admin/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::get('admin/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::get('admin/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
Route::get('admin/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');
Route::post('admin/profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('admin/profiles', [ProfileController::class, 'index'])->name('profiles.index');



//Rotas de Categorias
Route::put('admin/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('admin/categorias/{url}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::any('admin/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
Route::get('admin/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::get('admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::post('admin/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('admin/categorias', [CategoriaController::class, 'index'])->name('categorias.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/', function () {
    //Alert::success('Success Title', 'Success Message');
    //toast('Success Toast','success');

    return view('welcome');
});


require __DIR__.'/auth.php';