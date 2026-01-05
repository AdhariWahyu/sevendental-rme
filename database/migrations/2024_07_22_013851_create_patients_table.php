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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('no_telepon');
            $table->string('pendidikan');
            $table->string('no_rekam_medis')->unique()->nullable();
            $table->string('NIK')->unique();
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('golongan_darah');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
