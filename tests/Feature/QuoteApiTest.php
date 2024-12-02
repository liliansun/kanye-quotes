<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\NewQuoteManager;
use App\Contracts\QuoteProviderInterface;
use Illuminate\Support\Facades\Http;
use Mockery;
use App\Models\ApiAccess;

class QuoteApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');

        $this->validToken = 'valid-token';
        ApiAccess::create(['name'=> 'test token', 'token' => $this->validToken]);
    }

    public function test_it_requires_api_access_token()
    {
        $response = $this->getJson('/quotes');

        $response->assertStatus(401)
            ->assertJson(['error' => 'Unauthenticated.']);
    }

    public function test_it_returns_default_number_of_quotes():void
    {
        Http::fake([
            'api.kanye.rest' => Http::response(['quote' => 'quote'], 200),
        ]);

        $mock = Mockery::mock(QuoteProviderInterface::class);
        $mock->shouldReceive('getQuotes')->with(5);
        $this->app->instance(QuoteProviderInterface::class, $mock);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->validToken)->getJson('/quotes');

        $response->assertStatus(200)
            ->assertJsonCount(5)
            ->assertJson(['quote', 'quote', 'quote', 'quote', 'quote']);
    }

    public function test_it_handles_empty_quotes(): void
    {
        Http::fake([
            'api.kanye.rest' => Http::response([], 200),
        ]);

        $mock = Mockery::mock(QuoteProviderInterface::class);
        $mock->shouldReceive('getQuotes')->with(5)->andReturn([]);
        $this->app->instance(QuoteProviderInterface::class, $mock);

        $response = $this->withHeader('Authorization', 'Bearer ' . $this->validToken)->getJson('/quotes');

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

