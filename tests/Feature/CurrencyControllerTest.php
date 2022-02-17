<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{

    public function test_return_all_currencies()
    {
        $response = $this->get('/api/currency');

        $response->assertStatus(200);
    }

    public function test_makes_the_exchange()
    {
        $response = $this->post('/api/currency/exchange', [
            'from' => 'EUR',
            'to' => 'USD',
            'amount' => 1.05
        ]);

        $response->assertStatus(200);
    }

    public function test_attempting_to_exchange_generates_error()
    {
        $this->expectExceptionMessage('Empty response received from Fixer.io');
        $response = $this->withoutExceptionHandling()->post('/api/currency/exchange', [
            'from' => 'USD',
            'to' => 'EUR',
            'amount' => 1.05
        ]);

        $response->assertStatus(500);
    }

}
