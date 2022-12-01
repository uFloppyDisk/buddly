<?php

use App\Http\Controllers\Admin\AdminPanelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\SearchController::class, 'index']);

Auth::routes(['verify' => true]);

Route::prefix('profile')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/edit', [App\Http\Controllers\ProfileController::class, 'edit_profile'])->name('profile.edit');
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin', [AdminPanelController::class, 'show'])->name('admin');
});