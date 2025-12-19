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

        // ★ 目標体重（weight_target から取得）
        $targetWeight = optional($user->weightTarget)->target_weight;

        // ★ 目標まで（最新体重 - 目標体重）
        $diff = ($latestWeight !== null && $targetWeight !== null)
            ? $latestWeight - $targetWeight
            : null;

        return view('weight_logs.index', compact(
            'user',
            'logs',
            'latestWeight',
            'diff',
            'targetWeight'
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

        // 最新体重
        $latestWeight = $logs->first()?->weight;

        // ★ 目標体重（weight_target）
        $targetWeight = optional($user->weightTarget)->target_weight;

        // ★ 目標まで
        $diff = ($latestWeight !== null && $targetWeight !== null)
            ? $latestWeight - $targetWeight
            : null;

        return view('weight_logs.index', compact(
            'user',
            'logs',
            'latestWeight',
            'diff',
            'targetWeight'
        ));
    }

    // 登録画面
    public function create()
    {
        return view('weight_logs.create');
    }

    // 登録処理
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

    // 編集画面
    public function edit(WeightLog $weightLog)
    {
        return view('weight_logs.edit', [
            'log' => $weightLog,
        ]);
    }

    // 更新
    public function update(Request $request, WeightLog $weightLog)
    {
        $validated = $request->validate([
            'date'              => ['required', 'date'],
            'weight'            => ['required', 'numeric'],
            'calorie'           => ['required', 'numeric'],
            'exercise_time'     => ['required', 'date_format:H:i'],
            'exercise_content'  => ['nullable', 'string', 'max:120'],
        ]);

        $weightLog->update([
            'date' => $validated['date'],
            'weight' => $validated['weight'],
            'calories' => $validated['calorie'],
            'exercise_time' => $validated['exercise_time'],
            'exercise_content' => $validated['exercise_content'],
        ]);

        return redirect()->route('weight_logs.index');
    }

    // 削除
    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect()->route('weight_logs.index');
    }

    // 目標体重編集
    public function editGoal()
    {
        return view('weight_logs.goal', [
            'user' => Auth::user(),
        ]);
    }

    // 目標体重更新（※次のSTEPで修正する）
    public function updateGoal(Request $request)
    {
    $validated = $request->validate([
        'goal_weight' => ['required', 'numeric', 'regex:/^\d{1,3}(\.\d)?$/'],
        ]);

    $user = Auth::user();

    $user->weightTarget()->updateOrCreate(
        ['user_id' => $user->id],
        ['target_weight' => $validated['goal_weight']]
    );

    return redirect()
        ->route('weight_logs.index')
        ->with('message', '目標体重を更新しました');
    }

}
