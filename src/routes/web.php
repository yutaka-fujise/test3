<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterStep1Controller;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\WeightLogController;

/*
|--------------------------------------------------------------------------
| 会員登録 STEP1
|--------------------------------------------------------------------------
*/

// STEP1 表示
Route::get('/register/step1', [RegisterStep1Controller::class, 'create'])
    ->name('register.step1');

// STEP1 送信
Route::post('/register/step1', [RegisterStep1Controller::class, 'store'])
    ->name('register.step1.store');

/*
|--------------------------------------------------------------------------
| 会員登録 STEP2
|--------------------------------------------------------------------------
*/

// STEP2 表示
Route::get('/register/step2', [RegisterStep2Controller::class, 'create'])
    ->name('register.step2');

// STEP2 送信
Route::post('/register/step2', [RegisterStep2Controller::class, 'store'])
    ->name('register.step2.store');

/*
|--------------------------------------------------------------------------
| 体重管理（ログイン後）
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/weight_logs', [WeightLogController::class, 'index'])
        ->name('weight_logs.index');

    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])
        ->name('weight_logs.search');

    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])
        ->name('weight_logs.create');

    Route::post('/weight_logs/create', [WeightLogController::class, 'store'])
        ->name('weight_logs.store');

    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])
        ->name('weight_logs.show');

    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])
        ->name('weight_logs.update');

    Route::post('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])
        ->name('weight_logs.delete');

    Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'editGoal'])
        ->name('weight_logs.goal_setting');

    Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoal'])
        ->name('weight_logs.goal_update');
});
