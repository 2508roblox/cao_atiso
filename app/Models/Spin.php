<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spin extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'voucher_item_id', 'result_text', 'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function voucherItem()
    {
        return $this->belongsTo(VoucherItem::class);
    }
}
