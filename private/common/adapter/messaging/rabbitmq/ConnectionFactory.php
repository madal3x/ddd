<?php

namespace common\adapter\messaging\rabbitmq;

use PhpAmqpLib\Connection\AMQPConnection;

class ConnectionFactory {
    /**
     * I ran into errors by reusing AMQPConnection
     *
     * @return AMQPConnection
     */
    public static function create() {
        return new AMQPConnection('localhost', 5672, 'guest', 'guest');
    }
}