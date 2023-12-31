<?php

use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\BankController;
use App\Http\Controllers\Web\BudgetController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ClassificationController;
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

    Route::prefix('classification')->group(function () {
        // Queries
        Route::get('/list',            [ClassificationController::class, 'list'])->name('app.classification.list');
        Route::get('/info/{id}',       [ClassificationController::class, 'info'])->name('app.classification.info');
        Route::get('/select',          [ClassificationController::class, 'select'])->name('app.classification.select');
        // Resources
        Route::get('/',                [ClassificationController::class, 'index'])->name('app.classification.index');
        Route::get('/create',          [ClassificationController::class, 'create'])->name('app.classification.create');
        Route::post('/',               [ClassificationController::class, 'store'])->name('app.classification.store');
        Route::get('/{id}',            [ClassificationController::class, 'show'])->name('app.classification.show');
        Route::get('/{id}/edit',       [ClassificationController::class, 'edit'])->name('app.classification.edit');
        Route::put('/{id}',            [ClassificationController::class, 'update'])->name('app.classification.update');
        Route::delete('/{id}',         [ClassificationController::class, 'destroy'])->name('app.classification.destroy');
        Route::delete('/{id}/restore', [ClassificationController::class, 'restore'])->name('app.classification.restore');
    });
    
    Route::prefix('account')->group(function () {
        // Queries
        Route::get('/list',            [AccountController::class, 'list'])->name('app.account.list');
        Route::get('/info/{id}',       [AccountController::class, 'info'])->name('app.account.info');
        Route::get('/select',          [AccountController::class, 'select'])->name('app.account.select');
        // Resources
        Route::get('/',                [AccountController::class, 'index'])->name('app.account.index');
        Route::get('/create',          [AccountController::class, 'create'])->name('app.account.create');
        Route::post('/',               [AccountController::class, 'store'])->name('app.account.store');
        Route::get('/{id}',            [AccountController::class, 'show'])->name('app.account.show');
        Route::get('/{id}/edit',       [AccountController::class, 'edit'])->name('app.account.edit');
        Route::put('/{id}',            [AccountController::class, 'update'])->name('app.account.update');
        Route::delete('/{id}',         [AccountController::class, 'destroy'])->name('app.account.destroy');
        Route::delete('/{id}/restore', [AccountController::class, 'restore'])->name('app.account.restore');
    });

    Route::prefix('category')->group(function () {
        // Queries
        Route::get('/list',            [CategoryController::class, 'list'])->name('app.category.list');
        Route::get('/info/{id}',       [CategoryController::class, 'info'])->name('app.category.info');
        Route::get('/select',          [CategoryController::class, 'select'])->name('app.category.select');
        // Resources
        Route::get('/',                [CategoryController::class, 'index'])->name('app.category.index');
        Route::get('/create',          [CategoryController::class, 'create'])->name('app.category.create');
        Route::post('/',               [CategoryController::class, 'store'])->name('app.category.store');
        Route::get('/{id}',            [CategoryController::class, 'show'])->name('app.category.show');
        Route::get('/{id}/edit',       [CategoryController::class, 'edit'])->name('app.category.edit');
        Route::put('/{id}',            [CategoryController::class, 'update'])->name('app.category.update');
        Route::delete('/{id}',         [CategoryController::class, 'destroy'])->name('app.category.destroy');
        Route::delete('/{id}/restore', [CategoryController::class, 'restore'])->name('app.category.restore');
    });

    Route::prefix('budget')->group(function () {
        // Queries
        Route::get('/list',            [BudgetController::class, 'list'])->name('app.budget.list');
        Route::get('/info/{id}',       [BudgetController::class, 'info'])->name('app.budget.info');
        Route::get('/select',          [BudgetController::class, 'select'])->name('app.budget.select');
        // Resources
        Route::get('/',                [BudgetController::class, 'index'])->name('app.budget.index');
        Route::get('/create',          [BudgetController::class, 'create'])->name('app.budget.create');
        Route::post('/',               [BudgetController::class, 'store'])->name('app.budget.store');
        Route::get('/{id}',            [BudgetController::class, 'show'])->name('app.budget.show');
        Route::get('/{id}/edit',       [BudgetController::class, 'edit'])->name('app.budget.edit');
        Route::put('/{id}',            [BudgetController::class, 'update'])->name('app.budget.update');
        Route::delete('/{id}',         [BudgetController::class, 'destroy'])->name('app.budget.destroy');
        Route::delete('/{id}/restore', [BudgetController::class, 'restore'])->name('app.budget.restore');
    });
});
