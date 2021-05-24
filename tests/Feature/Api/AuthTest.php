<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/v1/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test auth with client fake
     *
     * @return void
     */
    public function testAuthClientFake()
    {
        $payload = [
            'email' => 'adasdasd@sdasda.com',
            'password' => '123123123',
            'device_name' => Str::random(10)
        ];

        $response = $this->postJson('/api/v1/auth/token', $payload);

        $response->assertStatus(404)
            ->assertExactJson([
                'message' => trans('messages.invalid_credencials')
            ]);
    }

    /**
     * Test auth success
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = factory(Client::class)->create();

        $payload = [
            'email' => $client->email,
            'password' => "password",
            'device_name' => Str::random(10)
        ];

        $response = $this->postJson('/api/v1/auth/token', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /**
     * Error get me
     *
     * @return void
     */
    public function testErrorGetMe()
    {
        $response = $this->getJson('/api/v1/auth/me');
        $response->assertStatus(401);
    }

    /**
     *  get me
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;
        $response = $this->getJson('/api/v1/auth/me', [
            'Authorization' => "Bearer {$token}"
        ]);
        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'name' => $client->name,
                    'email' => $client->email
                ]
            ]);
    }

    /**
     *  Logout
     *
     * @return void
     */
    public function testLogout()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;
        $response = $this->postJson('/api/v1/auth/logout', [],
            [
                'Authorization' => "Bearer {$token}"
            ]);
        $response->assertStatus(204);

    }
}
