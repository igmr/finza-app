<?php

use App\Http\Controllers\Web\AccountController;
use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\BankController;
use App\Http\Controllers\Web\BudgetController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ClassificationController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\DebtController;
use App\Http\Controllers\Web\EgressController;
use App\Http\Controllers\Web\GenderController;
use App\Http\Controllers\Web\IngressController;
use App\Http\Controllers\Web\SavingController;
use App\Http\Controllers\Web\transactionController;
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
        Route::get('/datatable',       [BankController::class, 'datatable'])->name('app.bank.datatable');
        Route::get('/detail/{id}',     [BankController::class, 'detail'])->name('app.bank.detail');
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
        Route::get('/datatable',       [GenderController::class, 'datatable'])->name('app.gender.datatable');
        Route::get('/detail/{id}',     [GenderController::class, 'detail'])->name('app.gender.detail');
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
        Route::get('/datatable',       [ClassificationController::class, 'datatable'])->name('app.classification.datatable');
        Route::get('/detail/{id}',     [ClassificationController::class, 'detail'])->name('app.classification.detail');
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
        Route::get('/datatable',       [AccountController::class, 'datatable'])->name('app.account.datatable');
        Route::get('/detail/{id}',     [AccountController::class, 'detail'])->name('app.account.detail');
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
        Route::get('/datatable',       [CategoryController::class, 'datatable'])->name('app.category.datatable');
        Route::get('/detail/{id}',     [CategoryController::class, 'detail'])->name('app.category.detail');
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
        Route::get('/datatable',       [BudgetController::class, 'datatable'])->name('app.budget.datatable');
        Route::get('/detail',          [BudgetController::class, 'detail'])->name('app.budget.detail');
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

    Route::prefix('saving')->group(function () {
        // Queries
        Route::get('/list',            [SavingController::class, 'list'])->name('app.saving.list');
        Route::get('/info/{id}',       [SavingController::class, 'info'])->name('app.saving.info');
        Route::get('/select',          [SavingController::class, 'select'])->name('app.saving.select');
        Route::get('/datatable',       [SavingController::class, 'datatable'])->name('app.saving.datatable');
        Route::get('/detail',          [SavingController::class, 'detail'])->name('app.saving.detail');
        // Resources
        Route::get('/',                [SavingController::class, 'index'])->name('app.saving.index');
        Route::get('/create',          [SavingController::class, 'create'])->name('app.saving.create');
        Route::post('/',               [SavingController::class, 'store'])->name('app.saving.store');
        Route::get('/{id}',            [SavingController::class, 'show'])->name('app.saving.show');
        Route::get('/{id}/edit',       [SavingController::class, 'edit'])->name('app.saving.edit');
        Route::put('/{id}',            [SavingController::class, 'update'])->name('app.saving.update');
        Route::delete('/{id}',         [SavingController::class, 'destroy'])->name('app.saving.destroy');
        Route::delete('/{id}/restore', [SavingController::class, 'restore'])->name('app.saving.restore');
    });

    Route::prefix('debt')->group(function () {
        // Queries
        Route::get('/list',            [DebtController::class, 'list'])->name('app.debt.list');
        Route::get('/info/{id}',       [DebtController::class, 'info'])->name('app.debt.info');
        Route::get('/select',          [DebtController::class, 'select'])->name('app.debt.select');
        Route::get('/datatable',       [DebtController::class, 'datatable'])->name('app.debt.datatable');
        Route::get('/detail/{id}',     [DebtController::class, 'detail'])->name('app.debt.detail');
        // Resources
        Route::get('/',                [DebtController::class, 'index'])->name('app.debt.index');
        Route::get('/create',          [DebtController::class, 'create'])->name('app.debt.create');
        Route::post('/',               [DebtController::class, 'store'])->name('app.debt.store');
        Route::get('/{id}',            [DebtController::class, 'show'])->name('app.debt.show');
        Route::get('/{id}/edit',       [DebtController::class, 'edit'])->name('app.debt.edit');
        Route::put('/{id}',            [DebtController::class, 'update'])->name('app.debt.update');
        Route::delete('/{id}',         [DebtController::class, 'destroy'])->name('app.debt.destroy');
        Route::delete('/{id}/restore', [DebtController::class, 'restore'])->name('app.debt.restore');
    });

    Route::prefix('ingress')->group(function () {
        // Queries
        Route::get('/list',            [IngressController::class, 'list'])->name('app.ingress.list');
        Route::get('/info/{id}',       [IngressController::class, 'info'])->name('app.ingress.info');
        Route::get('/select',          [IngressController::class, 'select'])->name('app.ingress.select');
        Route::get('/datatable',       [IngressController::class, 'datatable'])->name('app.ingress.datatable');
        Route::get('/detail',          [IngressController::class, 'detail'])->name('app.ingress.detail');
        // Resources
        Route::get('/',                [IngressController::class, 'index'])->name('app.ingress.index');
        Route::get('/create',          [IngressController::class, 'create'])->name('app.ingress.create');
        Route::post('/',               [IngressController::class, 'store'])->name('app.ingress.store');
        Route::get('/{id}',            [IngressController::class, 'show'])->name('app.ingress.show');
        Route::get('/{id}/edit',       [IngressController::class, 'edit'])->name('app.ingress.edit');
        Route::put('/{id}',            [IngressController::class, 'update'])->name('app.ingress.update');
        Route::delete('/{id}',         [IngressController::class, 'destroy'])->name('app.ingress.destroy');
        Route::delete('/{id}/restore', [IngressController::class, 'restore'])->name('app.ingress.restore');
    });

    Route::prefix('egress')->group(function () {
        // Queries
        Route::get('/list',            [EgressController::class, 'list'])->name('app.egress.list');
        Route::get('/info/{id}',       [EgressController::class, 'info'])->name('app.egress.info');
        Route::get('/select',          [EgressController::class, 'select'])->name('app.egress.select');
        Route::get('/datatable',       [EgressController::class, 'datatable'])->name('app.egress.datatable');
        Route::get('/detail',          [EgressController::class, 'detail'])->name('app.egress.detail');
        // Resources
        Route::get('/',                [EgressController::class, 'index'])->name('app.egress.index');
        Route::get('/create',          [EgressController::class, 'create'])->name('app.egress.create');
        Route::post('/',               [EgressController::class, 'store'])->name('app.egress.store');
        Route::get('/{id}',            [EgressController::class, 'show'])->name('app.egress.show');
        Route::get('/{id}/edit',       [EgressController::class, 'edit'])->name('app.egress.edit');
        Route::put('/{id}',            [EgressController::class, 'update'])->name('app.egress.update');
        Route::delete('/{id}',         [EgressController::class, 'destroy'])->name('app.egress.destroy');
        Route::delete('/{id}/restore', [EgressController::class, 'restore'])->name('app.egress.restore');
    });

    Route::prefix('transaction')->group(function () {
        // Queries
        Route::get('/list',            [transactionController::class, 'list'])->name('app.transaction.list');
        Route::get('/info/{id}',       [transactionController::class, 'info'])->name('app.transaction.info');
        Route::get('/select',          [transactionController::class, 'select'])->name('app.transaction.select');
        Route::get('/datatable',       [transactionController::class, 'datatable'])->name('app.transaction.datatable');
        Route::get('/detail',          [transactionController::class, 'detail'])->name('app.transaction.detail');
        // Resources
        Route::get('/',                [transactionController::class, 'index'])->name('app.transaction.index');
        Route::get('/create',          [transactionController::class, 'create'])->name('app.transaction.create');
        Route::post('/',               [transactionController::class, 'store'])->name('app.transaction.store');
        Route::get('/{id}',            [transactionController::class, 'show'])->name('app.transaction.show');
        Route::get('/{id}/edit',       [transactionController::class, 'edit'])->name('app.transaction.edit');
        Route::put('/{id}',            [transactionController::class, 'update'])->name('app.transaction.update');
        Route::delete('/{id}',         [transactionController::class, 'destroy'])->name('app.transaction.destroy');
        Route::delete('/{id}/restore', [transactionController::class, 'restore'])->name('app.transaction.restore');
    });
});
