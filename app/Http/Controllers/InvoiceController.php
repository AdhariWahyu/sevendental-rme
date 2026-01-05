<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function preview($id)
    {
        $invoice = Transaction::with('patient')->find($id);
        return view('invoice.indexv', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = Transaction::with('patient')->find($id);
        $pdf = Pdf::loadView('invoice.index', [
            'invoice' => $invoice
        ]);
        $name = 'INVOICE-' . $invoice->id . '.pdf';
        return $pdf->download($name);
    }

    public function print($id)
    {
        $invoice = Transaction::with('patient')->find($id);
        $pdf = Pdf::loadView('invoice.index', [
            'invoice' => $invoice
        ]);

        return $pdf->stream('INVOICE-' . $invoice->id . '.pdf');
    }
}
