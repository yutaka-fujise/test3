<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WeightLog extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'weight',
        'calorie',
        'exercise_time',
        'exercise_content',
    ];

    /**
     * この体重ログを所有するユーザー
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}