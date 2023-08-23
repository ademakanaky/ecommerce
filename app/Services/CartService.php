<?php

namespace App\Services;

use App\Kafka\CustomMessage;
use App\Kafka\KafkaProducer;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    protected KafkaProducer $kafkaProducer;

    public function __construct(KafkaProducer $kafkaProducer)
    {
        $this->kafkaProducer = $kafkaProducer;
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception
     */
    public function addToCart(Product $product, $quantity = 1)
    {
        $payload = json_encode(["user_id" => \auth()->user()->id, "product_id" => $product->id]);
        $customMessage = new CustomMessage($payload);
        $this->kafkaProducer->sendToCartItemsTopic($customMessage);

    }

    public function removeFromCart(Cart $cartItem)
    {
        $cartItem->delete();
    }

    public function getCartItems(): Collection
    {
        return auth()->user()->cartItems;
    }

    public function clearCart()
    {
        auth()->user()->cartItems()->delete();
    }
}
