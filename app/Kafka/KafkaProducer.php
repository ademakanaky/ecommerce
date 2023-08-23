<?php

namespace App\Kafka;

use Enqueue\RdKafka\RdKafkaConnectionFactory;

class KafkaProducer
{
    protected $connectionFactory;

    public function __construct()
    {
        $this->connectionFactory = new RdKafkaConnectionFactory([
            'global' => [
                'group.id' => 'laravel-kafka-producer',
                'metadata.broker.list' => 'localhost:9092',
            ],
            'topic' => [
                'auto.offset.reset' => 'earliest',
            ],
        ]);
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception
     */
    public function sendToCartItemsTopic($message)
    {
        $context = $this->connectionFactory->createContext();
        $topic = $context->createTopic('cart_items');

        $producer = $context->createProducer();
        $producer->send($topic, $message);
    }

    /**
     * @throws \Interop\Queue\Exception\InvalidMessageException
     * @throws \Interop\Queue\Exception\InvalidDestinationException
     * @throws \Interop\Queue\Exception
     */
    public function sendToCheckoutTopic($message)
    {
        $context = $this->connectionFactory->createContext();
        $topic = $context->createTopic('checkout');

        $producer = $context->createProducer();
        $producer->send($topic, $message);
    }
}
