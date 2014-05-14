<?php

namespace common\adapter\messaging\rabbitmq;

use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Channel;

abstract class ExchangeTopicListener {
    protected $connection;
    protected $attached;
    protected $channel;

    public function __construct(AMQPConnection $connection) {
        $this->connection = $connection;

        $this->attachToQueue();
        $this->listen();
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
        $this->attached = true;

        $channel = $this->connection->channel();

        $channel->exchange_declare($this->exchangeName(), 'topic', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        foreach($this->listensTo() as $binding_key) {
            $channel->queue_bind($queue_name, $this->exchangeName(), $binding_key);
        }

        $channel->basic_consume($queue_name, '', false, true, false, false, array($this, 'filteredDispatch'));

        $this->channel = $channel;
    }

    protected function listen() {
        while($this->isAttached() && count($this->channel->callbacks)) {
            $this->channel->wait();
        }

        $this->channel->close();
    }

    protected function detachFromQueue() {
        $this->attached = false;
    }

    protected function isAttached() {
        return $this->attached;
    }

    abstract protected function exchangeName();

    abstract protected function listensTo();
}