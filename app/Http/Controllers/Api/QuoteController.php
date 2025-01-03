<?php

namespace App\Http\Controllers\Api;

use App\Facades\NewQuote;
use App\Http\Controllers\Controller;
use App\Services\NewQuoteManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class QuoteController extends Controller
{
    protected $quoteManager;

    public function __construct(NewQuoteManager $quoteManager)
    {
        $this->quoteManager = $quoteManager;
    }

    public function getQuotes(Request $request)
    {
        //First checks if the kanye_quotes cache key exists.
        //If the key exists, it serves the cached data.
        //If not, it fetches fresh quotes from the external API and stores them in the cache.

        $quotes = Cache::remember('kanye_quotes', 300, function () use ($request) {
            $count = $request->input('count', 5);
            $driver = $request->input('driver', 'kanyeRest');
            return NewQuote::driver($driver)->getQuotes($count);
        });

        return response()->json($quotes);
    }

    public function refreshQuotes(Request $request)
    {
        $count = $request->input('count', 5);
        $driver = $request->input('driver', 'kanyeRest');

        $quotes = NewQuote::driver($driver)->getQuotes($count);

        Cache::put('kanye_quotes', $quotes, 300);

        return response()->json($quotes);
    }
}
