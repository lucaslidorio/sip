<?php

use App\Http\Controllers\Admin\CategoriaController;
use Illuminate\Support\Facades\Route;


//Rotas de Categorias
Route::put('admin/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('admin/categorias/{url}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::any('admin/categorias/search', [CategoriaController::class, 'search'])->name('categorias.search');
Route::get('admin/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::get('admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
Route::post('admin/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('admin/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('admin/', [CategoriaController::class, 'index'])->name('admin.index');


Route::get('/', function () {
    //Alert::success('Success Title', 'Success Message');
    //toast('Success Toast','success');

    return view('welcome');
});
