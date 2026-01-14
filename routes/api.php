<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JoinPilotController;
use App\Http\Controllers\Api\StayUpdatedController;
use App\Http\Controllers\Api\HeroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes for form submissions
Route::post('/join-pilot', [JoinPilotController::class, 'store']);
Route::post('/stay-updated', [StayUpdatedController::class, 'store']);

// Hero content route
Route::get('/hero', [HeroController::class, 'getHeroByLang']);

// Protected routes for admin access
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/join-pilots', [JoinPilotController::class, 'index']);
    Route::get('/stay-updated-list', [StayUpdatedController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});