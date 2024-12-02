<?php

namespace App\Facades;

use App\Services\NewQuoteManager;
use Illuminate\Support\Facades\Facade;

class NewQuote extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'newQuote';
    }
}
