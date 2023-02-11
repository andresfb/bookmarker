<?php

use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HiddenController;
use App\Http\Controllers\SectionsController;
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

    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('/section/{section}', SectionsController::class)->name('section');

    Route::get('/archived', ArchivedController::class)->name('archived');

    Route::controller(HiddenController::class)->group(function () {
        Route::get('/hidden', 'index')->name('hidden');
        Route::patch('/hidden', 'save')->name('hidden.access');
        Route::delete('/hidden', 'destroy')->name('hidden.reset');
    });

});

// TODO: add the routes controllers and views for Tags.
// TODO: Add tooltips to the buttons
// TODO: Add notifications
// TODO: Implement search
// TODO: Add hCaptcha after the first login fail
// TODO: Test two-factor auth
// TODO: Registration by invitation
// TODO: Create a Command to send an invitation code
// TODO: Larastan fixes
