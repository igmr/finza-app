<?php

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\BankController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\GenderController;
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

    Route::prefix('bank')->group(function () {
        // Queries
        Route::get('/list',            [BankController::class, 'list'])->name('app.bank.list');
        Route::get('/info/{id}',       [BankController::class, 'info'])->name('app.bank.info');
        Route::get('/select',          [BankController::class, 'select'])->name('app.bank.select');
        // Resources
        Route::get('/',                [BankController::class, 'index'])->name('app.bank.index');
        Route::get('/create',          [BankController::class, 'create'])->name('app.bank.create');
        Route::post('/',               [BankController::class, 'store'])->name('app.bank.store');
        Route::get('/{id}',            [BankController::class, 'show'])->name('app.bank.show');
        Route::get('/{id}/edit',       [BankController::class, 'edit'])->name('app.bank.edit');
        Route::put('/{id}',            [BankController::class, 'update'])->name('app.bank.update');
        Route::delete('/{id}',         [BankController::class, 'destroy'])->name('app.bank.destroy');
        Route::delete('/{id}/restore', [BankController::class, 'restore'])->name('app.bank.restore');
    });

    Route::prefix('gender')->group(function () {
        // Queries
        Route::get('/list',            [GenderController::class, 'list'])->name('app.gender.list');
        Route::get('/info/{id}',       [GenderController::class, 'info'])->name('app.gender.info');
        Route::get('/select',          [GenderController::class, 'select'])->name('app.gender.select');
        // Resources
        Route::get('/',                [GenderController::class, 'index'])->name('app.gender.index');
        Route::get('/create',          [GenderController::class, 'create'])->name('app.gender.create');
        Route::post('/',               [GenderController::class, 'store'])->name('app.gender.store');
        Route::get('/{id}',            [GenderController::class, 'show'])->name('app.gender.show');
        Route::get('/{id}/edit',       [GenderController::class, 'edit'])->name('app.gender.edit');
        Route::put('/{id}',            [GenderController::class, 'update'])->name('app.gender.update');
        Route::delete('/{id}',         [GenderController::class, 'destroy'])->name('app.gender.destroy');
        Route::delete('/{id}/restore', [GenderController::class, 'restore'])->name('app.gender.restore');
    });
});
