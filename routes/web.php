<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrometheusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|----------------------------
| Dashboard Route
|----------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'dashboard']);

/*
|----------------------------
| Prometheus Metrics
|----------------------------
*/
Route::get('/prometheus', [PrometheusController::class, 'metrics']);

/*
|----------------------------
| Activity Logs
|----------------------------
*/
Route::get('/activities', [ActivityController::class, 'index']);

/*
|----------------------------
| Dashboard Stats API
|----------------------------
*/
Route::get('/dashboard-stats', [DashboardController::class, 'stats']);