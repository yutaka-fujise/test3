<?php

namespace App\Models;

use App\Models\WeightLog;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーが持つ体重ログ
     */
    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }

    public function weightTarget()
    {
    return $this->hasOne(\App\Models\WeightTarget::class);
    }
}
