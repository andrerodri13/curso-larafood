<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * validation Create Order
     *
     * @return void
     */
    public function testValidationCreateNewOrder()
    {
        $response = $this->postJson('/api/v1/orders', []);

        $response->assertStatus(422)
            ->assertJsonPath('errors.token_company', [trans('validation.required', ['attribute' => 'token company'])])
            ->assertJsonPath('errors.products', [trans('validation.required', ['attribute' => 'products'])]);
    }

    /**
     *  Create Order
     *
     * @return void
     */
    public function testCreateNewOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = factory(Product::class, 10)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 2
            ]);
        }
        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     *  Tatal Order
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }
        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 30.30);
    }

    /**
     *   Order not found
     *
     * @return void
     */
    public function testOrderNotFound()
    {
        $order = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }

    /**
     *  Get Order
     *
     * @return void
     */
    public function testGetOrder()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     *  Teste Create a New Order Authenticated
     *
     * @return void
     */
    public function testCreateNewOrderAuthenticated()
    {
        $client = factory(Client::class)->create();
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => []
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/v1/auth/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201);
    }

    /**
     *  Teste Create a New Order with Table
     *
     * @return void
     */
    public function testCreateNewOrderWithTable()
    {
        $table = factory(Table::class)->create();
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'table' => $table->uuid,
            'products' => []
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qtd' => 1
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);

    }

    /**
     *  Teste get My orders
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        factory(Order::class, 2)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/v1/auth/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
    }


}
