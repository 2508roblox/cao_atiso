<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spins', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropColumn('voucher_id');
            $table->foreignId('voucher_item_id')->nullable()->constrained('voucher_items')->nullOnDelete()->after('customer_id');
        });
    }

    public function down(): void
    {
        Schema::table('spins', function (Blueprint $table) {
            $table->dropForeign(['voucher_item_id']);
            $table->dropColumn('voucher_item_id');
            $table->foreignId('voucher_id')->nullable()->constrained('vouchers')->nullOnDelete()->after('customer_id');
        });
    }
}; 