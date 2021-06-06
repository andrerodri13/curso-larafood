<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrderRequest;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * OrderController constructor.
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createNewOrder($request->all());

        broadcast(new OrderCreated($order));

        return new OrderResource($order);
    }

    public function show($identify)
    {
        if (!$order = $this->orderService->getOrderByIdentify($identify)) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return new OrderResource($order);
    }

    public function myOrders()
    {
        $orders = $this->orderService->ordersByClient();

        return OrderResource::collection($orders);

    }
}
