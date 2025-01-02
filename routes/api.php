<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['api-access'])->group(function () {
    Route::get('/quotes', [\App\Http\Controllers\Api\QuoteController::class, 'getQuotes']);
});
