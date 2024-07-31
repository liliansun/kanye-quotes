<?php

namespace App\Providers\QuoteProviders;

use App\Contracts\QuoteProviderInterface;
use Illuminate\Support\Facades\Http;

class KanyeRestProvider implements QuoteProviderInterface
{
    public function getQuotes($count)
    {
        $quotes = [];
        for ($i = 0; $i < $count; $i++) {
            $response = Http::get(config('quote.api_url'));
            if (!$response->json()) {
                continue;
            }
            $quotes[] = $response->json()['quote'];
        }

        return $quotes;
    }
}
