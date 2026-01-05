<?php

namespace App\Models;

use App\Events\MedicalReportCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class MedicalReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'no_rekam_medis',
        'slug'
    ];

    protected $dispatchesEvents = [
        'created' => MedicalReportCreated::class,
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function catatanRekamMedis()
    {
        return $this->hasMany(CatatanRekamMedis::class);
    }

    // public function transaksi()
    // {
    //     return $this->hasMany(Transaction::class);
    // }

    public function setNameAttribute($value)
    {
        $this->attributes['patient_id'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
