<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OnlineUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'last_activity',
    ];

    protected $casts = [
        'last_activity' => 'datetime',
    ];

    public static function updateOnlineStatus($ip)
    {
        return static::updateOrCreate(
            ['ip_address' => $ip],
            ['last_activity' => now()]
        );
    }

    public static function cleanup()
    {
        return static::where('last_activity', '<', now()->subMinutes(5))->delete();
    }

    public static function getOnlineCount()
    {
        static::cleanup();
        return static::count();
    }
} 