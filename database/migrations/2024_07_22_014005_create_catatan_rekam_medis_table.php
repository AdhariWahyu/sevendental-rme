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
        Schema::create('catatan_rekam_medis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_report_id')->constrained('medical_reports')->cascadeOnDelete();
            $table->foreignId('patient_appointment_id')->constrained('patient_appointments')->cascadeOnDelete();
            $table->date('tanggal_pemeriksaan');
            $table->text('anamnesa');
            $table->text('pemeriksaan');
            $table->text('diagnosa');
            $table->text('terapi');
            $table->text('anjuran');
            $table->decimal('total_biaya', 15, 2);
            $table->decimal('bayar', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_rekam_medis');
    }
};
