<?php

namespace reporting\adapter\messaging\rabbitmq\factory;

use common\adapter\messaging\rabbitmq\ConnectionFactory;
use reporting\adapter\messaging\rabbitmq\UserEventListener;

class UserEventListenerFactory {
    public static function create() {
        return new UserEventListener(ConnectionFactory::create());
    }
}