<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $title = 'Chào mừng đến với trang chủ';
    public $description = 'Đây là trang chủ được tạo bằng Livewire';
    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.home')->layout('components.layouts.app', ['title' => 'Vòng quay may mắn']);
    }
}
