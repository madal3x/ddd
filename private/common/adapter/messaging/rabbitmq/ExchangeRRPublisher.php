<?php

namespace common\adapter\messaging\rabbitmq;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

abstract class ExchangeRRPublisher {
    private $connection;

    public function __construct(AMQPConnection $connection) {
        $this->connection = $connection;
    }

    function __destruct() {
        $this->connection->close();
    }

    public function publish($message) {
        $channel = $this->connection->channel();

        $channel->queue_declare($this->exchangeName(), false, true, false, false);

        $msg = new AMQPMessage(
            serialize($message),
            array('delivery_mode' => 2)
        );

        $channel->basic_publish($msg, '', $this->exchangeName());

        $channel->close();
    }

    abstract protected function exchangeName();
}