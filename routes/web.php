<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CompanyController;

// sleep(2);
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // -- company management
    Route::get('/company', [CompanyController::class, 'index'])->name('company');
    Route::resource('/company', CompanyController::class)->except(['index','update']);
    Route::post('/company/{company}', [CompanyController::class, 'update'])->name('company.update');
    // -- company management

    // -- article management
    // Route::get('/createArticle', [ArticleController::class, 'create'])->name('createArticle');

    Route::get('/article', [ArticleController::class, 'index'])->name('article');
    Route::resource('/article', ArticleController::class)->except(['index','update']);
    Route::post('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
    // -- article management

});
