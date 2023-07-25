<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\StatusController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/animes/decrement/{id}', [AnimeController::class, 'decrementWatched']);
    Route::get('/animes/increment/{id}', [AnimeController::class, 'incrementWatched']);
    Route::get('/animes/add/{id}', [AnimeController::class, 'addToUserList'])->middleware('auth');
    Route::get('/animes/remove/{id}', [AnimeController::class, 'removeFromUserList'])->middleware('auth');
    Route::get('/animes/my-list', [AnimeController::class, 'userList'])->name('animes.user_list')->middleware('auth');
    Route::resource("/animes", AnimeController::class);

    Route::resource("/studios", StudioController::class);
    Route::resource("/status", StatusController::class);
});

require __DIR__ . '/auth.php';
