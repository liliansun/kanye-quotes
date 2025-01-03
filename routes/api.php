<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['api-access'])->group(function () {
    Route::get('/quotes', [\App\Http\Controllers\Api\QuoteController::class, 'getQuotes'])->name('quotes.list');
    Route::get('/refresh-quotes', [\App\Http\Controllers\Api\QuoteController::class, 'refreshQuotes'])->name('quotes.refresh');
});
