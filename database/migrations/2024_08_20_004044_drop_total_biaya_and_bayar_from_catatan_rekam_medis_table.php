<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('catatan_rekam_medis', function (Blueprint $table) {
            $table->dropColumn(['total_biaya', 'bayar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catatan_rekam_medis', function (Blueprint $table) {
            $table->decimal('total_biaya', 15, 2);
            $table->decimal('bayar', 15, 2);
        });
    }
};
