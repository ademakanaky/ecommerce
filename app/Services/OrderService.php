<?php

namespace App\Services;

use App\Kafka\CustomMessage;
use App\Kafka\KafkaProducer;
use Illuminate\Support\Collection;

class OrderService
{
    protected $kafkaProducer;

    public function __construct(KafkaProducer $kafkaProducer)
    {
        $this->kafkaProducer = $kafkaProducer;
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception
     */
    public function createOrder(Collection $cartItems)
    {
        $payload = json_encode(["user_id" => \auth()->user()->id, "product_id" => $cartItems]);
        $customMessage = new CustomMessage($payload);
        $this->kafkaProducer->sendToCheckoutTopic($customMessage);
    }

    public function getCartItemsForUser(): Collection
    {
        return auth()->user()->cartItems->load('product');
    }
}
