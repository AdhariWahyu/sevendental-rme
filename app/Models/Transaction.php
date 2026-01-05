<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_invoice',
        'patient_id',
        'jenis_perawatan',
        'notes',
        'jumlah',
        'terbilang',
        'paid_date',
        'address_option'
    ];

    public function setJenisPerawatanAttribute($value)
    {
        $this->attributes['jenis_perawatan'] = json_encode($value);
    }

    public function getAddressLine1Attribute(): string
    {
        return match ($this->address_option) {
            'praktek_second' => 'Jl. Wisma Permai Tengah IX Blok KK No.7',
            'klinik_original' => 'Jl. Dharmahusada Indah I No. 90 / L-175',
            'praktek_original' => 'Jl. Dharmahusada Indah I No. 90 / L-175',
            'second' => 'Jl. Wisma Permai Tengah IX Blok KK No.7',
            'original' => 'Jl. Dharmahusada Indah I No. 90 / L-175',
            default => 'Jl. Dharmahusada Indah I No. 90 / L-175',
        };
    }

    public function getHeaderTitleAttribute(): string
    {
        return match ($this->address_option) {
            'praktek_second' => 'PRAKTEK DOKTER GIGI',
            'klinik_original' => 'KLINIK SEVENDENTAL',
            'praktek_original' => 'PRAKTEK DOKTER GIGI',
            'second' => 'PRAKTEK DOKTER GIGI',
            'original' => 'PRAKTEK DOKTER GIGI',
            default => 'PRAKTEK DOKTER GIGI',
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->no_invoice)) {
                $model->no_invoice = 'dhu-' . mt_rand(1000000000, 9999999999);
            }
            if (!is_null($model->jumlah)) {
                $model->terbilang = self::terbilang($model->jumlah) . ' Rupiah';
            }
        });

        static::updating(function ($model) {
            if (!is_null($model->jumlah)) {
                $model->terbilang = self::terbilang($model->jumlah) . ' Rupiah';
            }
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public static function terbilang($nilai)
    {
        $angka = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $teks = ['Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];

        $ribuan = ['Ribu', 'Juta', 'Milyar', 'Triliun'];

        if ($nilai < 20) {
            return $teks[$nilai];
        }

        if ($nilai < 100) {
            $puluhan = intval($nilai / 10);
            $satuan = $nilai % 10;
            return trim($teks[$puluhan] . ' Puluh ' . ($satuan ? $teks[$satuan] : ''));
        }

        if ($nilai < 1000) {
            $ratusan = intval($nilai / 100);
            $sisa = $nilai % 100;
            if ($ratusan == 1) {
                return trim('Seratus ' . ($sisa ? self::terbilang($sisa) : ''));
            } else {
                return trim($teks[$ratusan] . ' Ratus ' . ($sisa ? self::terbilang($sisa) : ''));
            }
        }

        for ($i = 0, $unit = 1000; $unit <= pow(1000, count($ribuan)); $i++, $unit *= 1000) {
            if ($nilai < $unit * 1000) {
                $utama = intval($nilai / $unit);
                $sisa = $nilai % $unit;
                $hasil = trim(self::terbilang($utama) . ' ' . $ribuan[$i]);
                return $sisa ? $hasil . ' ' . self::terbilang($sisa) : $hasil;
            }
        }

        return '';
    }
}
