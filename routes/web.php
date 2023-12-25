<?php

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  [AuthenticationController::class, 'create'])->name('authentication');
Route::post('/', [AuthenticationController::class, 'store'])->name('authentication.store');

Route::middleware(['auth'])->prefix('app')->group(function () {
    Route::post('/logout', [AuthenticationController::class, 'destroy'])->name('authentication.destroy');
    Route::get('/',        [DashboardController::class, 'index'])->name('dashboard');
});
