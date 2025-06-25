<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VoucherItem;
use App\Models\Voucher;
use App\Models\Spin;
use Illuminate\Support\Facades\Session;

class SpinWheel extends Component
{
    public $prizes = [];
    public $voucherItemIds = [];
    public $showModal = false;
    public $resultText = '';
    public $resultVoucher = null;

    public function mount()
    {
        // Lấy 8 voucher item chưa dùng, random
        $voucherItems = VoucherItem::with('voucher')
            ->where('is_used', false)
            ->inRandomOrder()
            ->limit(8)
            ->get();
        $prizes = [];
        $voucherItemIds = [];
        foreach ($voucherItems as $item) {
            $prizes[] = $item->voucher->voucher_name ?? 'Voucher';
            $voucherItemIds[] = $item->id;
        }
        // Nếu chưa đủ 8, thêm "Chúc bạn may mắn lần sau"
        while (count($prizes) < 8) {
            $prizes[] = 'Chúc bạn may mắn lần sau';
            $voucherItemIds[] = null;
        }
        $this->prizes = $prizes;
        $this->voucherItemIds = $voucherItemIds;
    }

    public function spinResult($index)
    {
        $customer = session('customer');
        $voucherItemId = $this->voucherItemIds[$index];
        $resultText = $this->prizes[$index];
        $voucher = null;
        if ($voucherItemId) {
            // Đánh dấu voucher item đã dùng
            $voucherItem = VoucherItem::find($voucherItemId);
            $voucherItem->is_used = true;
            $voucherItem->customer_id = $customer['id'] ?? null;
            $voucherItem->used_at = now();
            $voucherItem->save();
            $voucher = $voucherItem->voucher;
        }
        // Lưu lịch sử quay
        Spin::create([
            'customer_id' => $customer['id'] ?? null,
            'voucher_item_id' => $voucherItemId,
            'result_text' => $resultText,
            'created_at' => now(),
        ]);
        $this->resultText = $resultText;
        $this->resultVoucher = $voucher;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.spin-wheel', [
            'prizes' => $this->prizes,
        ]);
    }
}
