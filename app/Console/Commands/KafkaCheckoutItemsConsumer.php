<?php

namespace App\Console\Commands;

use App\Kafka\KafkaProducer;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Enqueue\RdKafka\RdKafkaConnectionFactory;
use Enqueue\RdKafka\RdKafkaConsumer;
use Enqueue\RdKafka\RdKafkaContext;
use Illuminate\Console\Command;

class KafkaCheckoutItemsConsumer extends Command
{
    protected $signature = 'kafka:consume-checkout-items-topic';
    protected $description = 'Consume messages from Kafka topic checkout';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $context = new RdKafkaContext([
            'global' => [
                'group.id' => 'checkout-consumer',
                'metadata.broker.list' => 'localhost:9092',
            ],
            'topic' => [
                'auto.offset.reset' => 'earliest',
            ],
        ]);

        $topic = 'checkout';

        $consumer = $context->createConsumer($context->createQueue($topic));

        $this->info('Listening for checkout items...');

        while (true) {
            $message = $consumer->receive();
            $this->createOrderFromMessage($message->getBody());
            $consumer->acknowledge($message);
        }
    }

    protected function createOrderFromMessage($message)
    {
        $payload = json_decode($message);
        $user_id = $payload->user_id;
        $product_id = $payload->product_id;
        $cartItems = Cart::with('product')->where('user_id',$user_id)
            ->whereIn('product_id',$product_id)->get();

        $totalAmount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->product->price * $cartItem->quantity;
        }

        $order = Order::create([
            'user_id' => $user_id,
            'total_amount' => $totalAmount,
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product->id,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->product->price * $cartItem->quantity,
            ]);
        }

        Cart::query()->where('user_id', $user_id)->delete();
    }
}
