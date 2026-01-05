<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class CatatanRekamMedis extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'medical_report_id', 'patient_appointment_id', 'slug', 'tanggal_pemeriksaan', 'anamnesa', 'pemeriksaan', 'diagnosa', 'terapi', 'anjuran', 'total_biaya', 'bayar'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function rekamMedis()
    {
        return $this->belongsTo(MedicalReport::class, 'medical_report_id');
    }

    public function appointment()
    {
        return $this->belongsTo(PatientAppointment::class, 'patient_appointment_id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['medical_report_id'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
