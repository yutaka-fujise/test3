<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;

class WeightLogController extends Controller
{
    // 一覧
    public function index()
    {
        $logs = auth()->user()
            ->weightLogs()
            ->orderBy('date', 'desc')
            ->paginate(8);

        return view('weight_logs.index', compact('logs'));
    }

    // 検索
    public function search(Request $request)
    {
        $query = auth()->user()->weightLogs();

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        return view('weight_logs.index', compact('logs'));
    }

    // 登録画面
    public function create()
    {
        return view('weight_logs.create');
    }

    // 登録処理
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'     => ['required', 'date'],
            'weight'   => ['required', 'numeric'],
            'calorie'  => ['nullable', 'numeric'],
            'exercise' => ['nullable', 'string'],
        ]);

        auth()->user()->weightLogs()->create($validated);

        return redirect()->route('weight_logs.index');
    }

    // 詳細
    public function show($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);

        return view('weight_logs.show', compact('log'));
    }

    // 更新
    public function update(Request $request, $weightLogId)
    {
        $validated = $request->validate([
            'date'     => ['required', 'date'],
            'weight'   => ['required', 'numeric'],
            'calorie'  => ['nullable', 'numeric'],
            'exercise' => ['nullable', 'string'],
        ]);

        $log = WeightLog::findOrFail($weightLogId);
        $log->update($validated);

        return redirect()->route('weight_logs.index');
    }

    // 削除
    public function destroy($weightLogId)
    {
        $log = WeightLog::findOrFail($weightLogId);
        $log->delete();

        return redirect()->route('weight_logs.index');
    }

    // 目標体重編集
    public function editGoal()
    {
        return view('weight_logs.goal');
    }

    // 目標体重更新
    public function updateGoal(Request $request)
    {
        $validated = $request->validate([
            'goal_weight' => ['required', 'numeric'],
        ]);

        auth()->user()->update([
            'goal_weight' => $validated['goal_weight'],
        ]);

        return redirect()->route('weight_logs.index');
    }
}
