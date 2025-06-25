<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsLog extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'phone', 'message', 'status', 'sent_at', 'created_at',
    ];
}
