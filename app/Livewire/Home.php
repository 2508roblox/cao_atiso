<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Home extends Component
{
    public $title = 'Chào mừng đến với trang chủ';
    public $description = 'Đây là trang chủ được tạo bằng Livewire';
    public $count = 0;
    public $name;
    public $phone;
    public $email;
    public $successMessage;
    public $errorMessage;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function submit()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'email.email' => 'Email không hợp lệ',
        ]);

        try {
            $customer = Customer::firstOrCreate(
                [ 'phone' => $this->phone ],
                [ 'name' => $this->name, 'email' => $this->email ]
            );
            // Lưu thông tin customer vào session
            session(['customer' => $customer->toArray()]);
            // Chuyển hướng tới route quay thưởng
            return redirect()->route('spin');
        } catch (\Exception $e) {
            $this->errorMessage = 'Có lỗi xảy ra, vui lòng thử lại.';
        }
    }

    public function render()
    {
        return view('livewire.home')->layout('components.layouts.app', ['title' => 'Vòng quay may mắn']);
    }
}
