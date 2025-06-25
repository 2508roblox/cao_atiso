<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'email',
    ];

    public function spins()
    {
        return $this->hasMany(Spin::class);
    }
}
