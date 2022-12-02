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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->prefix('chat')->group(function () {
    Route::get('/', [\App\Http\Controllers\ChatController::class, 'index'])->name('chat');
    Route::get('/{conversation_id}', [\App\Http\Controllers\ChatController::class, 'show'])->name('chat.view');
    Route::post('/{conversation_id}/new-message', [\App\Http\Controllers\ChatController::class, 'update'])->name('chat.new-message');
});

Route::middleware(['admin'])->group(function () {
    Route::get('admin', [AdminPanelController::class, 'show'])->name('admin');
});