<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;

class RegisterStep1Controller extends Controller
{
    public function store(RegisterStep1Request $request)
    {
        // STEP1の入力値をセッションに保存
        session([
            'register' => $request->validated()
        ]);

        // STEP2へ遷移
        return redirect()->route('register.step2');
    }
    public function create()
    {
    return view('auth.register_step1');
    }
}