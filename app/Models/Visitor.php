<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'count',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public static function incrementToday()
    {
        $today = now()->format('Y-m-d');
        return static::updateOrCreate(
            ['date' => $today],
            ['count' => \DB::raw('count + 1')]
        );
    }
} 