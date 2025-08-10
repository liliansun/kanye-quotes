<?php

namespace App\Services;

use App\Providers\QuoteProviders\JsonFileProvider;
use App\Providers\QuoteProviders\KanyeRestProvider;
use Illuminate\Support\Manager;

class NewQuoteManager extends Manager
{

    protected function createKanyeRestDriver()
    {
        return new KanyeRestProvider();
    }

    protected function createJsonFileDriver()
    {
        return new JsonFileProvider();
    }

    public function getDefaultDriver()
    {
        return $this->config->get('kanye.driver', 'kanyeRest');
    }
}
