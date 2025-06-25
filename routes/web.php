<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\SpinWheel;

Route::get('/', Home::class);
Route::get('/quay-thuong', SpinWheel::class)->name("spin");
