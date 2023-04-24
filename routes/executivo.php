<?php

use App\Http\Controllers\Site\SiteExecutivoController;
use Illuminate\Support\Facades\Route;



Route::get('/', [SiteExecutivoController::class, 'index'])->name('site.home');
Route::get('/noticias/{url?}', [SiteExecutivoController::class, 'noticias'])->name('site.noticias');
Route::get('noticias/{url}/ler', [SiteExecutivoController::class, 'noticiaLer'])->name('noticia.show');

