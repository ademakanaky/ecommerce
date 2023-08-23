<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception
     */
    public function addToCart(Request $request, $productId): RedirectResponse
    {
        $quantity = $request->input('quantity', 1);
        $product = Product::findOrFail($productId);

        $this->cartService->addToCart($product, $quantity);

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = Cart::findOrFail($cartItemId);

        $this->cartService->removeFromCart($cartItem);

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

    public function viewCart()
    {
        $cartItems = $this->cartService->getCartItems();

        return view('cart.view', compact('cartItems'));
    }
}
