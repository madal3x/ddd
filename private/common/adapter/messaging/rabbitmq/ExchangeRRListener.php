<?php

namespace common\adapter\messaging\rabbitmq;

use PhpAmqpLib\Connection\AMQPConnection;

abstract class ExchangeRRListener {
    protected $connection;

    public function __construct(AMQPConnection $connection) {
        $this->connection = $connection;

        $this->attachToQueue();
    }

    function __destruct() {
        $this->connection->close();
    }

    /**
     * PhpAmqpLib expects this to be public
     *
     * @param AMQPMessage
     * @return mixed
     */
    abstract public function filteredDispatch($message);

    protected function attachToQueue() {
        $channel = $this->connection->channel();

        $channel->queue_declare($this->exchangeName(), false, true, false, false);

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume($this->exchangeName(), '', false, false, false, false, array($this, 'filteredDispatch'));

        while(count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
    }

    abstract protected function exchangeName();
}