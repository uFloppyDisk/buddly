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

Route::middleware('auth')->prefix('profile')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('/user/{profile_id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit', [App\Http\Controllers\ProfileController::class, 'edit_start'])->name('profile.edit');
    Route::post('/edit/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.edit.publish');
});

Route::middleware('auth')->prefix('chat')->group(function () {
    Route::get('/', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat');
    Route::get('/{conversation_id}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.view');
    Route::get('/new/{account_id}', [\App\Http\Controllers\ChatController::class, 'create'])->name('chat.new');
    Route::post('/{conversation_id}/message/new', [\App\Http\Controllers\ChatController::class, 'update'])->name('chat.new-message');
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin', [AdminPanelController::class, 'show'])->name('admin');
});