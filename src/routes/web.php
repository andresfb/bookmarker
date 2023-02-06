<?php

use App\Http\Controllers\DashboardController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'cache.refresh',
])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('/{section}', 'view')->name('dashboard.view');
    });
});

// TODO: add the routes controllers and views for Tags, Archive, and Hidden.
// TODO: Add a Tag filter to the dashboard index and view methods.
// TODO: Add tooltips to the buttons
// TODO: Add notifications
// TODO: Implement search
