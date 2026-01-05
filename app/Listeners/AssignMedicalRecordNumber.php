<?php

namespace App\Listeners;

use App\Events\MedicalReportCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Patient;

class AssignMedicalRecordNumber
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MedicalReportCreated $event)
    {
        $medicalReport = $event->medicalReport;
        $patient = $medicalReport->patient;

        // Assign nomor rekam medis yang diinput secara manual ke data pasien
        $patient->no_rekam_medis = $medicalReport->no_rekam_medis;
        $patient->save();
    }
}

