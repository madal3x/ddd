<?php

namespace idaccess\adapter\messaging\rabbitmq\factory;

use common\adapter\messaging\rabbitmq\ConnectionFactory;
use idaccess\adapter\messaging\rabbitmq\CommandListener;
use idaccess\application\command\handler\factory\CommandHandlerFactory;

class CommandListenerFactory {
    private static $instance;

    public static function create() {
        if ( ! isset(self::$instance)) {
            self::$instance = new CommandListener(ConnectionFactory::create());
        }

        return self::$instance;
    }
}