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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Animes: User List
    Route::patch('/animes/update_watched/{id}', [AnimeController::class, 'updateWatched'])->name('animes.update_watched');
    Route::get('/animes/add/{id}', [AnimeController::class, 'addToUserList'])->middleware('auth');
    Route::get('/animes/remove/{id}', [AnimeController::class, 'removeFromUserList'])->middleware('auth');
    Route::get('/animes/my-list', [AnimeController::class, 'userList'])->name('animes.user_list')->middleware('auth');
    Route::get('/animes/user_list/search', [AnimeController::class, 'searchInUserList'])->name('animes.user_list.search');
    //Animes: Admin Control
    Route::get('/animes/create', [AnimeController::class, 'create'])->name('animes.create')->middleware('role:admin');
    Route::post('/animes/store', [AnimeController::class, 'store'])->name('animes.store')->middleware('role:admin');
    Route::put('/animes/{id}/update', [AnimeController::class, 'update'])->name('animes.update')->middleware('role:admin');
    Route::get('/animes/{id}/edit', [AnimeController::class, 'edit'])->name('animes.edit')->middleware('role:admin');
    Route::delete('/animes/{id}/destroy', [AnimeController::class, 'destroy'])->name('animes.destroy')->middleware('role:admin');
    //Animes: User
    Route::get('/animes', [AnimeController::class, 'index'])->name('animes.index');
    Route::get('/animes/{id}', [AnimeController::class, 'show'])->name('animes.show');
    Route::patch('/animes/update_rating/{id}', [AnimeController::class, 'updateRating'])->name('animes.update_rating');
    Route::post('/animes/{anime}/comments', [AnimeController::class, 'storeComment'])->name('animes.comments.store');
    Route::get('/comments/{comment}/edit', [AnimeController::class, 'editComment'])->name('comments.edit');
    Route::patch('/comments/{comment}', [AnimeController::class, 'updateComment'])->name('comments.update');
    Route::delete('/comments/{comment}', [AnimeController::class, 'deleteComment'])->name('comments.delete');
    //Studios: Admin Control
    Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create')->middleware('role:admin');
    Route::post('/studios/store', [StudioController::class, 'store'])->name('studios.store')->middleware('role:admin');
    Route::put('/studios/{id}/update', [StudioController::class, 'update'])->name('studios.update')->middleware('role:admin');
    Route::get('/studios/{id}/edit', [StudioController::class, 'edit'])->name('studios.edit')->middleware('role:admin');
    Route::delete('/studios/{id}/destroy', [StudioController::class, 'destroy'])->name('studios.destroy')->middleware('role:admin');
    Route::get('/studios', [StudioController::class, 'index'])->name('studios.index')->middleware('role:admin');
    //Studios: User
    Route::get('/studios/{id}', [StudioController::class, 'show'])->name('studios.show');
    //Status: Admin Control
    Route::get('/status/create', [StatusController::class, 'create'])->name('status.create')->middleware('role:admin');
    Route::post('/status/store', [StatusController::class, 'store'])->name('status.store')->middleware('role:admin');
    Route::put('/status/{id}/update', [StatusController::class, 'update'])->name('status.update')->middleware('role:admin');
    Route::get('/status/{id}/edit', [StatusController::class, 'edit'])->name('status.edit')->middleware('role:admin');
    Route::delete('/status/{id}/destroy', [StatusController::class, 'destroy'])->name('status.destroy')->middleware('role:admin');
    Route::get('/status', [StatusController::class, 'index'])->name('status.index')->middleware('role:admin');
});

require __DIR__ . '/auth.php';
