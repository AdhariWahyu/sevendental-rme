<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;



Route::get('preview-invoice/{id}', [InvoiceController::class, 'preview'])->name('preview-invoice');
Route::get('download-invoice/{id}', [InvoiceController::class, 'download'])->name('download-invoice');
Route::get('/invoice/print/{id}', [InvoiceController::class, 'print'])->name('print-invoice');

// Route::get('/storage-link', function() {
//     Artisan::call('storage:link');
//     return "Storage Link Successful";
// });


Route::get('/', function () {
    return redirect('/admin/login');
});
