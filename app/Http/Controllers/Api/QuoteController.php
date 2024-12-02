<?php

namespace App\Http\Controllers\Api;

use App\Facades\NewQuote;
use App\Http\Controllers\Controller;
use App\Services\NewQuoteManager;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    protected $quoteManager;

    public function __construct(NewQuoteManager $quoteManager)
    {
        $this->quoteManager = $quoteManager;
    }

    public function getQuotes(Request $request)
    {
        $count = $request->input('count', 5);
        $driver = $request->input('driver', 'kanyeRest');

        $quotes = NewQuote::driver($driver)->getQuotes($count);

        return response()->json($quotes);
    }
}
