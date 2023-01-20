<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiddleController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\MatchController;
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

Route::get('/dashboard', [UserProfileController::class, 'show'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/user/{userId}', [UserProfileController::class, 'showUser'])->middleware(['auth', 'verified'])->name('user.user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/userProfile', [UserProfileController::class, 'update'])->name('userProfile.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/match/find', [MatchController::class, 'find_match'])->name('match.find');
    Route::get('/match/show', [MatchController::class, 'show_matches'])->name('match.show');
    Route::post('/match/accept', [MatchController::class, 'accept_match'])->name('match.accept');
    Route::post('/match/deny', [MatchController::class, 'deny_match'])->name('match.deny');
    Route::get('/match/notification', [MatchController::class, 'notify'])->name('match.notification');
    Route::post('/match/filter', [MatchController::class, 'apply_filters'])->name('match.filter');
});

require __DIR__.'/auth.php';

Route::resource('/riddles', RiddleController::class);
Route::get('/riddles/page/{noPage}', [RiddleController::class, 'page'])->name('riddles.page');
Route::post('/riddles/random', [RiddleController::class, 'random'])->name('riddles.random');
Route::post('/riddles/filter', [RiddleController::class, 'filter'])->name('riddles.filter');
Route::post('/riddles/answer', [RiddleController::class, 'answer'])->name('riddles.answer');
