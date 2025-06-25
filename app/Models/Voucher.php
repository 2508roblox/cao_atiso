<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'voucher_name', 'description', 'value', 'chance',
    ];

    public function spins()
    {
        return $this->hasMany(Spin::class);
    }
}
