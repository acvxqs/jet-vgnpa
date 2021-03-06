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

    Route::get('dashboard', [ Acvxqs\JetVgnpa\Http\Controllers\DashboardController::class, 'show' ])->name('dashboard');
    Route::put('teams/{team}/dashboard', [ Acvxqs\JetVgnpa\Http\Controllers\DashboardController::class, 'update' ])->name('team-dashboard.update');

    Route::put('user/profile-timezone', [ Acvxqs\JetVgnpa\Http\Controllers\UserProfileTimezone::class , 'update' ])->name('user-profile-timezone.update');
    Route::put('user/profile-contact', [ Acvxqs\JetVgnpa\Http\Controllers\UserProfileContact::class , 'update' ])->name('user-profile-contact.update');
});