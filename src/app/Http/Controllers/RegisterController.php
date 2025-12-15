<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // STEP1 表示
    public function step1()
    {
        return view('register.step1');
    }

    // STEP1 保存
    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        auth()->login($user);

        return redirect()->route('register.step2');
    }

    // STEP2 表示
    public function step2()
    {
        return view('register.step2');
    }

    // STEP2 保存
    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'current_weight' => ['required', 'numeric'],
            'goal_weight'    => ['required', 'numeric'],
        ]);

        $user = auth()->user();

        $user->update([
            'goal_weight' => $validated['goal_weight'],
        ]);

        // 最初の体重ログ登録（任意）
        $user->weightLogs()->create([
            'date'   => now(),
            'weight' => $validated['current_weight'],
        ]);

        return redirect()->route('weight_logs.index');
    }
}
