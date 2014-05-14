<?php

namespace shop\adapter\messaging\rabbitmq;

use common\adapter\messaging\Exchanges;
use common\adapter\messaging\rabbitmq\ExchangeRRPublisher;

class IdAccessCommandPublisher extends ExchangeRRPublisher {
    protected function exchangeName() {
        return Exchanges::IDACCESS_COMMAND_EXCHANGE;
    }
}