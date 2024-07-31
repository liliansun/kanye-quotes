<?php

namespace App\Providers\QuoteProviders;

use App\Contracts\QuoteProviderInterface;
use Illuminate\Support\Facades\Http;

class JsonFileProvider implements QuoteProviderInterface
{
    public function getQuotes($count)
    {
        $json = file_get_contents(storage_path('quotes.json'));
        $allQuotes = json_decode($json, true);

        return array_slice($allQuotes, 0, $count);
    }
}
