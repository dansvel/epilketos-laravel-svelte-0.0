<?php

use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/', [VoterController::class, 'welcome'])->name('voter.welcome');
Route::get('/login', [VoterController::class, 'login'])->name('voter.login');
Route::post('/login', [VoterController::class, 'login'])->name('voter.login');
Route::get('/vote', [VoterController::class, 'vote'])->name('voter.vote');
Route::post('/vote', [VoterController::class, 'vote'])->name('voter.vote');
Route::get('/live-count', [VoterController::class, 'liveCount'])->name('voter.liveCount');
Route::post('/live-count', [VoterController::class, 'liveCount'])->name('voter.liveCount');
