<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'pendidikan',
        'no_rekam_medis',
        'NIK',
        'tinggi_badan',
        'berat_badan',
        'golongan_darah',
        'agama',
        'pekerjaan'
    ];

    public function medicalReport()
    {
        return $this->hasOne(MedicalReport::class);
    }

    public function appointments()
    {
        return $this->hasMany(PatientAppointment::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
