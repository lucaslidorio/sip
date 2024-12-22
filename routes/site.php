<?php

use App\Http\Controllers\Site\SitePublicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SitePublicoController::class, 'index'])->name('site.index');