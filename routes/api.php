<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ClassificationController;
use App\Http\Controllers\Api\DebtController;
use App\Http\Controllers\Api\SavingController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\BudgetController;
use App\Http\Controllers\Api\IngressController;
use App\Http\Controllers\Api\EgressController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login',          [AuthenticationController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::get('/',                [UserController::class, 'index']);
    Route::get('/{id}',            [UserController::class, 'show']);
    Route::post('/',               [UserController::class, 'store']);
    Route::put('/{id}',            [UserController::class, 'update']);
    Route::delete('/{id}',         [UserController::class, 'destroy']);
    Route::delete('/{id}/restore', [UserController::class, 'restore']);
});

Route::prefix('bank')->group(function () {
    Route::get('/',                [BankController::class, 'index']);
    Route::get('/{id}',            [BankController::class, 'show']);
    Route::post('/',               [BankController::class, 'store']);
    Route::put('/{id}',            [BankController::class, 'update']);
    Route::delete('/{id}',         [BankController::class, 'destroy']);
    Route::delete('/{id}/restore', [BankController::class, 'restore']);
});

Route::prefix('gender')->group(function () {
    Route::get('/',                [GenderController::class, 'index']);
    Route::get('/{id}',            [GenderController::class, 'show']);
    Route::post('/',               [GenderController::class, 'store']);
    Route::put('/{id}',            [GenderController::class, 'update']);
    Route::delete('/{id}',         [GenderController::class, 'destroy']);
    Route::delete('/{id}/restore', [GenderController::class, 'restore']);
});

Route::prefix('category')->group(function () {
    Route::get('/',                [CategoryController::class, 'index']);
    Route::get('/{id}',            [CategoryController::class, 'show']);
    Route::post('/',               [CategoryController::class, 'store']);
    Route::put('/{id}',            [CategoryController::class, 'update']);
    Route::delete('/{id}',         [CategoryController::class, 'destroy']);
    Route::delete('/{id}/restore', [CategoryController::class, 'restore']);
});

Route::prefix('classification')->group(function () {
    Route::get('/',                [ClassificationController::class, 'index']);
    Route::get('/{id}',            [ClassificationController::class, 'show']);
    Route::post('/',               [ClassificationController::class, 'store']);
    Route::put('/{id}',            [ClassificationController::class, 'update']);
    Route::delete('/{id}',         [ClassificationController::class, 'destroy']);
    Route::delete('/{id}/restore', [ClassificationController::class, 'restore']);
});

Route::prefix('debt')->group(function () {
    Route::get('/',                [DebtController::class, 'index']);
    Route::get('/{id}',            [DebtController::class, 'show']);
    Route::post('/',               [DebtController::class, 'store']);
    Route::put('/{id}',            [DebtController::class, 'update']);
    Route::delete('/{id}',         [DebtController::class, 'destroy']);
    Route::delete('/{id}/restore', [DebtController::class, 'restore']);
});

Route::prefix('saving')->group(function () {
    Route::get('/',                [SavingController::class, 'index']);
    Route::get('/{id}',            [SavingController::class, 'show']);
    Route::post('/',               [SavingController::class, 'store']);
    Route::put('/{id}',            [SavingController::class, 'update']);
    Route::delete('/{id}',         [SavingController::class, 'destroy']);
    Route::delete('/{id}/restore', [SavingController::class, 'restore']);
});

Route::prefix('account')->group(function () {
    Route::get('/',                [AccountController::class, 'index']);
    Route::get('/{id}',            [AccountController::class, 'show']);
    Route::post('/',               [AccountController::class, 'store']);
    Route::put('/{id}',            [AccountController::class, 'update']);
    Route::delete('/{id}',         [AccountController::class, 'destroy']);
    Route::delete('/{id}/restore', [AccountController::class, 'restore']);
});

Route::prefix('budget')->group(function () {
    Route::get('/',                [BudgetController::class, 'index']);
    Route::get('/{id}',            [BudgetController::class, 'show']);
    Route::post('/',               [BudgetController::class, 'store']);
    Route::put('/{id}',            [BudgetController::class, 'update']);
    Route::delete('/{id}',         [BudgetController::class, 'destroy']);
    Route::delete('/{id}/restore', [BudgetController::class, 'restore']);
});

Route::prefix('ingress')->group(function () {
    Route::get('/',                [IngressController::class, 'index']);
    Route::get('/{id}',            [IngressController::class, 'show']);
    Route::post('/',               [IngressController::class, 'store']);
    Route::put('/{id}',            [IngressController::class, 'update']);
    Route::delete('/{id}',         [IngressController::class, 'destroy']);
    Route::delete('/{id}/restore', [IngressController::class, 'restore']);
});

Route::prefix('egress')->group(function () {
    Route::get('/',                [EgressController::class, 'index']);
    Route::get('/{id}',            [EgressController::class, 'show']);
    Route::post('/',               [EgressController::class, 'store']);
    Route::put('/{id}',            [EgressController::class, 'update']);
    Route::delete('/{id}',         [EgressController::class, 'destroy']);
    Route::delete('/{id}/restore', [EgressController::class, 'restore']);
});

Route::prefix('transaction')->group(function () {
    Route::get('/',                [TransactionController::class, 'index']);
    Route::get('/{id}',            [TransactionController::class, 'show']);
    Route::post('/',               [TransactionController::class, 'store']);
    Route::put('/{id}',            [TransactionController::class, 'update']);
    Route::delete('/{id}',         [TransactionController::class, 'destroy']);
    Route::delete('/{id}/restore', [TransactionController::class, 'restore']);
});
