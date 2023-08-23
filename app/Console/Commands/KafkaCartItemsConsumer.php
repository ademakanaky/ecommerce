<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Enqueue\RdKafka\RdKafkaContext;
use Illuminate\Console\Command;

class KafkaCartItemsConsumer extends Command
{
    protected $signature = 'kafka:consume-cart-items-topic';
    protected $description = 'Consume messages from Kafka topic cart_items';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $context = new RdKafkaContext([
            'global' => [
                'group.id' => 'cart-items-consumer',
                'metadata.broker.list' => 'localhost:9092',
            ],
            'topic' => [
                'auto.offset.reset' => 'earliest',
            ],
        ]);

        // Specify the topic name
        $topic = 'cart_items';
        $consumer = $context->createConsumer($context->createQueue($topic));
        $this->info('Listening for cart items...');

        while (true) {
            $message = $consumer->receive();
            $this->storeCartItemInDatabase($message->getBody());
            $consumer->acknowledge($message);
        }
    }

    protected function storeCartItemInDatabase($message)
    {
        // Store the cart item in the database
        $payload = json_decode($message);
        $user_id = $payload->user_id;
        $product_id = $payload->product_id;
        $cartItem = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();
        $cartItem ? $cartItem->increment('quantity') : Cart::create(['user_id' => $user_id, 'product_id' => $product_id, 'quantity' => 1]);
    }
}
