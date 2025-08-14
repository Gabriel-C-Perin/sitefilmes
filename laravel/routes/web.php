<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// catalogo publico
Route::get('/filmes', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/filmes/{movie}', [CatalogController::class, 'show'])->name('catalog.show');

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

// middleware rotas admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
	Route::resource('categories', AdminCategoryController::class);
	Route::resource('movies', AdminMovieController::class);
});
