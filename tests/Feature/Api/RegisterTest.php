<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error Create new Client
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'Andre da Silva Rodrigues',
            'email' => 'andrerodri13@hotmail.com'
        ];

        $response = $this->postJson('/api/v1/auth/register', $payload);
        $response->assertStatus(422);
    }

    /**
     * Success Create new Client
     *
     * @return void
     */
    public function testCreateNewClient()
    {
        $payload = [
            'name' => 'Andre da Silva Rodrigues',
            'email' => 'andrerodri13@hotmail.com',
            'password' => '12345678'
        ];

        $response = $this->postJson('/api/v1/auth/register', $payload);

        $response->assertStatus(201)
        ->assertExactJson([
            'data' => [
                'name' => 'Andre da Silva Rodrigues',
                'email' => 'andrerodri13@hotmail.com',
            ]
        ]);

    }
}
