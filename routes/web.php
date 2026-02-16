<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/politics', [HomeController::class, 'politics'])->name('politics');
Route::get('/business', [HomeController::class, 'business'])->name('business');
Route::get('/sports', [HomeController::class, 'sports'])->name('sports');
Route::get('/technology', [HomeController::class, 'technology'])->name('technology');
Route::get('/entertainment', [HomeController::class, 'entertainment'])->name('entertainment');

Route::middleware('admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/add-news', [AdminController::class, 'addNews'])->name('admin.addNews');
    Route::post('/admin/news', [AdminController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news-view', [AdminController::class, 'newsView'])->name('admin.newsView');
    Route::get('/admin/news/{id}/edit', [AdminController::class, 'editNews'])->name('admin.editNews');
    Route::put('/admin/news/{id}', [AdminController::class, 'updateNews'])->name('admin.news.update');
    Route::delete('/admin/news/{id}', [AdminController::class, 'deleteNews'])->name('admin.news.delete');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::get('/admin/users/{id}', [AdminController::class, 'showUser'])->name('users.show');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('users.destroy');
    Route::patch('/admin/users/{id}/status', [AdminController::class, 'toggleUserStatus'])->name('users.toggleStatus');
    Route::get('/admin/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
