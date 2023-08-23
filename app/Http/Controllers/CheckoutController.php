<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception
     */
    public function checkout(Request $request)
    {
        $cartItems = $this->cartService->getCartItems()->pluck('product_id');
        $this->orderService->createOrder($cartItems);

        return view('cart.success');
    }
}
