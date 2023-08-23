<?php

namespace App\Kafka;

use Enqueue\RdKafka\RdKafkaMessage;
use Interop\Queue\Message;

class CustomMessage extends RdKafkaMessage implements Message
{
    private $body;
    private $properties;
    private $name;
    private $value;

    public function __construct($body, array $properties = [])
    {
        $this->body = $body;
        $this->properties = $properties;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    // Implement other required methods and properties...
    public function setProperties(array $properties): void
    {
        $this->properties = $properties;
    }

    /**
     * Returns [name => value, ...]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function setProperty(string $name, $value): void
    {
        // TODO: Implement setProperty() method.
    }

    public function getProperty(string $name, $default = null)
    {
        // TODO: Implement getProperty() method.
    }

    public function setHeaders(array $headers): void
    {
        // TODO: Implement setHeaders() method.
    }

    /**
     * Returns [name => value, ...]
     */
    public function getHeaders(): array
    {
        return ['name' => $this->name, 'value' => $this->value];
    }

    public function setHeader(string $name, $value): void
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getHeader(string $name, $default = null)
    {
        // TODO: Implement getHeader() method.
    }

    public function setRedelivered(bool $redelivered): void
    {
        // TODO: Implement setRedelivered() method.
    }

    /**
     * Gets an indication of whether this message is being redelivered.
     * The message is considered as redelivered,
     * when it was sent by a broker to consumer but consumer does not ACK or REJECT it.
     * The broker brings the message back to the queue and mark it as redelivered.
     */
    public function isRedelivered(): bool
    {
        // TODO: Implement isRedelivered() method.
    }

    /**
     * Sets the correlation ID for the message.
     * A client can use the correlation header field to link one message with another.
     * A typical use is to link a response message with its request message.
     */
    public function setCorrelationId(string $correlationId = null): void
    {
        // TODO: Implement setCorrelationId() method.
    }

    /**
     * Gets the correlation ID for the message.
     * This method is used to return correlation ID values that are either provider-specific message IDs
     * or application-specific String values.
     */
    public function getCorrelationId(): ?string
    {
        // TODO: Implement getCorrelationId() method.
    }

    /**
     * Sets the message ID.
     * Providers set this field when a message is sent.
     * This method can be used to change the value for a message that has been received.
     */
    public function setMessageId(string $messageId = null): void
    {
        // TODO: Implement setMessageId() method.
    }

    /**
     * Gets the message Id.
     * The MessageId header field contains a value that uniquely identifies each message sent by a provider.
     *
     * When a message is sent, MessageId can be ignored.
     */
    public function getMessageId(): ?string
    {
        // TODO: Implement getMessageId() method.
    }

    /**
     * Gets the message timestamp.
     * The timestamp header field contains the time a message was handed off to a provider to be sent.
     * It is not the time the message was actually transmitted,
     * because the actual send may occur later due to transactions or other client-side queueing of messages.
     */
    public function getTimestamp(): ?int
    {
        // TODO: Implement getTimestamp() method.
    }

    /**
     * Sets the message timestamp.
     * Providers set this field when a message is sent.
     * This method can be used to change the value for a message that has been received.
     */
    public function setTimestamp(int $timestamp = null): void
    {
        // TODO: Implement setTimestamp() method.
    }/**
 * Sets the destination to which a reply to this message should be sent.
 * The ReplyTo header field contains the destination where a reply to the current message should be sent. If it is null, no reply is expected.
 * The destination may be a Queue only. A topic is not supported at the moment.
 * Messages sent with a null ReplyTo value may be a notification of some event, or they may just be some data the sender thinks is of interest.
 * Messages with a ReplyTo value typically expect a response.
 * A response is optional; it is up to the client to decide. These messages are called requests.
 * A message sent in response to a request is called a reply.
 * In some cases a client may wish to match a request it sent earlier with a reply it has just received.
 * The client can use the CorrelationID header field for this purpose.
 */
    public function setReplyTo(string $replyTo = null): void
    {
        // TODO: Implement setReplyTo() method.
    }

    /**
     * Gets the destination to which a reply to this message should be sent.
     */
    public function getReplyTo(): ?string
    {
        // TODO: Implement getReplyTo() method.
    }
}
