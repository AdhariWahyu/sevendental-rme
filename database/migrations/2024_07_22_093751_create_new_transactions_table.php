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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->nullable();
            $table->foreignId('patient_id')->constrained();
            $table->string('jenis_perawatan');
            $table->text('notes')->nullable();
            $table->decimal('jumlah', 15, 2)->nullable();
            $table->string('terbilang')->nullable();
            $table->date('paid_date')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
