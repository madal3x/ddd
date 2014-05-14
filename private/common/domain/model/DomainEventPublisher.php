<?php

namespace common\domain\model;

use common\adapter\messaging\rabbitmq\ExchangeTopicPublisher;

class DomainEventPublisher {
    /** @var $subscribers DomainEventSubscriber[] */
    private $subscribers;
    private $exchangePublisher;

    public function __construct(ExchangeTopicPublisher $exchangePublisher) {
        $this->subscribers = array();

        $this->exchangePublisher = $exchangePublisher;
    }

    public function subscribe(DomainEventSubscriber $subscriber) {
        $this->subscribers[] = $subscriber;
    }

    public function publish(DomainEvent $event) {
        foreach ($this->subscribers as $subscriber) {
            $subscriber->handleEvent($event);
        }

        $this->exchangePublisher->publish($event);
    }
}