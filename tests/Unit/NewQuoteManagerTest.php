<?php

namespace Tests\Unit;

use App\Services\NewQuoteManager;
use Tests\TestCase;

class NewQuoteManagerTest extends TestCase
{
    public function test_it_uses_kanye_config_as_default_driver(): void
    {
        config(['kanye.driver' => 'jsonFile']);

        $manager = app(NewQuoteManager::class);

        $this->assertSame('jsonFile', $manager->getDefaultDriver());
    }
}
