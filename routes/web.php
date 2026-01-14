<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [DashboardController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('/login', [DashboardController::class, 'login'])->name('admin.login');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/join-pilots', [DashboardController::class, 'joinPilots'])->name('admin.join.pilots');
        Route::get('/stay-updated', [DashboardController::class, 'stayUpdated'])->name('admin.stay.updated');
        Route::delete('/join-pilots/{id}', [DashboardController::class, 'deleteJoinPilot'])->name('admin.join.pilot.delete');
        Route::delete('/stay-updated/{id}', [DashboardController::class, 'deleteStayUpdated'])->name('admin.stay.updated.delete');
        
        // Hero management routes
        Route::get('/hero', [HeroController::class, 'index'])->name('admin.hero.index');
        Route::post('/hero', [HeroController::class, 'store'])->name('admin.hero.store');
    });
});
