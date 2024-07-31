<?php

namespace App\Services;

use App\Providers\QuoteProviders\JsonFileProvider;
use App\Providers\QuoteProviders\KanyeRestProvider;
use InvalidArgumentException;

class QuoteManager
{
    protected $drivers = [];

    public function driver($driver = null)
    {
        $driver = $driver ?: $this->getDefaultDriver();

        if (!isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver);
        }

        return $this->drivers[$driver];
    }

    protected function createDriver($driver)
    {
        $method = 'create' . ucfirst($driver) . 'Driver';

        if (!method_exists($this, $method)) {
            throw new InvalidArgumentException("Driver [$driver] not supported.");
        }

        return $this->{$method}();
    }

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
        return 'kanyeRest';
    }

    public function setDefaultDriver($driver)
    {
        $this->defaultDriver = $driver;
    }
}
