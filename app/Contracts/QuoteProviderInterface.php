<?php

namespace App\Contracts;

interface QuoteProviderInterface
{
    public function getQuotes($count);
}
