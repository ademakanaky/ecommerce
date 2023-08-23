<?php

namespace App\Http\Controllers;

use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function checkout()
    {
        $cartItems = $this->orderService->getCartItemsForUser();

        $order = $this->orderService->createOrder($cartItems);

        return view('checkout.success', compact('order'));
    }
}
