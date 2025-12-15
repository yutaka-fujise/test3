<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WeightLogController;

/*
|--------------------------------------------------------------------------
| 認証関連
|--------------------------------------------------------------------------
*/

// ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 会員登録
|--------------------------------------------------------------------------
*/

// STEP1 会員登録
Route::get('/register/step1', [RegisterController::class, 'step1'])->name('register.step1');
Route::post('/register/step1', [RegisterController::class, 'storeStep1']);

// STEP2 初期体重登録
Route::get('/register/step2', [RegisterController::class, 'step2'])->name('register.step2');
Route::post('/register/step2', [RegisterController::class, 'storeStep2']);


/*
|--------------------------------------------------------------------------
| 体重管理（ログイン後）
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // トップページ（体重一覧）
    Route::get('/weight_logs', [WeightLogController::class, 'index'])
        ->name('weight_logs.index');

    // 体重検索
    Route::get('/weight_logs/search', [WeightLogController::class, 'search'])
        ->name('weight_logs.search');

    // 体重登録画面
    Route::get('/weight_logs/create', [WeightLogController::class, 'create'])
        ->name('weight_logs.create');

    // 体重登録処理
    Route::post('/weight_logs/create', [WeightLogController::class, 'store'])
        ->name('weight_logs.store');

    // 体重詳細
    Route::get('/weight_logs/{weightLogId}', [WeightLogController::class, 'show'])
        ->name('weight_logs.show');

    // 体重更新
    Route::post('/weight_logs/{weightLogId}/update', [WeightLogController::class, 'update'])
        ->name('weight_logs.update');

    // 体重削除
    Route::post('/weight_logs/{weightLogId}/delete', [WeightLogController::class, 'destroy'])
        ->name('weight_logs.delete');

    // 目標体重設定
    Route::get('/weight_logs/goal_setting', [WeightLogController::class, 'editGoal'])
        ->name('weight_logs.goal_setting');

    Route::post('/weight_logs/goal_setting', [WeightLogController::class, 'updateGoal'])
        ->name('weight_logs.goal_update');
});
