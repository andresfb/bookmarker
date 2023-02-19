<?php

use App\Http\Controllers\ArchivedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HiddenController;
use App\Http\Controllers\MarkerController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\TagsController;
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

    Route::get('/marker/{marker}', MarkerController::class)->name('marker');

    Route::get('/section/{section}', SectionsController::class)->name('section');

    Route::get('/tags', TagsController::class)->name('tags');

    Route::get('/archived', ArchivedController::class)->name('archived');

    Route::controller(HiddenController::class)->group(function () {
        Route::get('/hidden', 'index')->name('hidden');
        Route::patch('/hidden', 'save')->name('hidden.access');
        Route::delete('/hidden', 'destroy')->name('hidden.reset');
    });

});
