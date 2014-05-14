<?php

namespace idaccess\adapter\messaging\rabbitmq;

use common\adapter\messaging\Exchanges;
use common\adapter\messaging\rabbitmq\ExchangeTopicPublisher;

class EventPublisher extends ExchangeTopicPublisher {
    protected function exchangeName() {
        return Exchanges::IDACCESS_EVENT_EXCHANGE;
    }
}