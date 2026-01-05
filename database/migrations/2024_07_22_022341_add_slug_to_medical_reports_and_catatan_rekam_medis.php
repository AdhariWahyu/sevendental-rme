<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToMedicalReportsAndCatatanRekamMedis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menambahkan kolom 'slug' pada tabel 'medical_reports'
        Schema::table('medical_reports', function (Blueprint $table) {
            $table->string('slug')->after('id')->unique()->nullable();
        });

        // Menambahkan kolom 'slug' pada tabel 'catatan_rekam_medis'
        Schema::table('catatan_rekam_medis', function (Blueprint $table) {
            $table->string('slug')->after('id')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Menghapus kolom 'slug' dari tabel 'medical_reports'
        Schema::table('medical_reports', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        // Menghapus kolom 'slug' dari tabel 'catatan_rekam_medis'
        Schema::table('catatan_rekam_medis', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
