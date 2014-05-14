<?php

namespace common\adapter\messaging\rabbitmq;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class ExchangeTopicPublisher {
    private $connection;

    public function __construct(AMQPConnection $connection) {
        $this->connection = $connection;
    }

    function __destruct() {
        $this->connection->close();
    }

    public function publish($message) {
        $channel = $this->connection->channel();

        $channel->exchange_declare($this->exchangeName(), 'topic', false, false, false);

        $routing_key = get_class($message);

        $msg = new AMQPMessage(serialize($message));

        $channel->basic_publish($msg, $this->exchangeName(), $routing_key);

        $channel->close();
    }

    abstract protected function exchangeName();
}