<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterStep2Controller extends Controller
{
    // STEP2 表示
    public function create()
    {
        return view('auth.register_step2');
    }

    // STEP2 登録処理
    public function store(RegisterStep2Request $request)
    {
        $step1 = session('register');

        if (!$step1) {
            return redirect()->route('register.step1');
        }

        // ユーザー作成
        $user = User::create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => Hash::make($step1['password']),
            'goal_weight' => $request->goal_weight,
        ]);

        // ログイン
        Auth::login($user);

        // 初期体重登録
        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $request->current_weight,
        ]);

        session()->forget('register');

        return redirect()->route('weight_logs.index');
    }
}
