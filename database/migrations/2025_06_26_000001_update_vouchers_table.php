<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->string('voucher_name')->after('id');
            $table->dropColumn('value');
        });
    }

    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->string('code')->after('id');
            $table->integer('value')->nullable()->after('description');
            $table->dropColumn('voucher_name');
        });
    }
}; 