<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWeightLogRequest;

class WeightLogController extends Controller
{
    // 一覧（管理画面）
    public function index()
    {
        $user = Auth::user();

        $logs = $user->weightLogs()
            ->orderBy('date', 'desc')
            ->paginate(8);

        // 最新体重
        $latestWeight = $logs->first()?->weight;

        // 目標まで（最新体重 - 目標体重）
        $diff = $latestWeight !== null
            ? $latestWeight - $user->goal_weight
            : null;

        return view('weight_logs.index', compact(
            'user',
            'logs',
            'latestWeight',
            'diff'
        ));
    }

    // 検索
    public function search(Request $request)
    {
        $user = Auth::user();

        $query = $user->weightLogs();

        if ($request->filled('from')) {
            $query->whereDate('date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('date', '<=', $request->to);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(8);

        $latestWeight = $logs->first()?->weight;

        $diff = $latestWeight !== null
            ? $latestWeight - $user->goal_weight
            : null;

        return view('weight_logs.index', compact(
            'user',
            'logs',
            'latestWeight',
            'diff'
        ));
    }

    // 登録画面
    public function create()
    {
        return view('weight_logs.create');
    }

    // 登録処理（FormRequest使用）
    public function store(StoreWeightLogRequest $request)
    {
        Auth::user()->weightLogs()->create($request->validated());

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
            'date'              => ['required', 'date'],
            'weight'            => ['required', 'numeric'],
            'calorie'           => ['required', 'numeric'],
            'exercise_time'     => ['required'],
            'exercise_content'  => ['nullable', 'string', 'max:120'],
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

        Auth::user()->update([
            'goal_weight' => $validated['goal_weight'],
        ]);

        return redirect()->route('weight_logs.index');
    }
}