<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_users', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->timestamp('last_activity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_users');
    }
}; 