<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * Teste Error create new Evaluation
     *
     * @return void
     */
    public function testErrorCreateNewEvaluation()
    {
        $order = 'fake_value';

        $response = $this->postJson("/api/v1/auth/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

    /**
     * Teste  create new Evaluation
     *
     * @return void
     */
    public function testCreateNewEvaluation()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = $client->orders()->save(factory(Order::class)->make());

        $payload = [
            'stars' => 5,
            'comment' => Str::random(10)
        ];

        $response = $this->postJson("/api/v1/auth/orders/{$order->identify}/evaluations", $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }
}
