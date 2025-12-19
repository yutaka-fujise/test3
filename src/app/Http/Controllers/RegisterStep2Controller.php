<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterStep2Controller extends Controller
{
    public function store(RegisterStep2Request $request)
    {
        // STEP1の情報を取得
        $step1 = session('register');

        if (!$step1) {
            return redirect()->route('register.step1');
        }

        // ユーザー作成
        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => Hash::make($step1['password']),
            'goal_weight' => $request->validated()['goal_weight'],
        ]);

        // ログイン
        Auth::login($user);

        // 初期体重ログ作成
        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $request->validated()['current_weight'],
        ]);

        // セッション削除
        session()->forget('register');

        // 管理画面へ
        return redirect()->route('weight_logs.index');
    }
}
