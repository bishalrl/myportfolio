<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;

// Public routes
Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

// Admin authentication routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('projects', AdminProjectController::class);
});
