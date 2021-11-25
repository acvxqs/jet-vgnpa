<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('/dashboard', [ Acvxqs\JetVgnpa\Http\Controllers\DashboardController::class, 'show' ])->name('dashboard');
    Route::put('/teams/{team}/dashboard', [ Acvxqs\JetVgnpa\Http\Controllers\DashboardController::class, 'update' ])->name('team-dashboard.update');
});