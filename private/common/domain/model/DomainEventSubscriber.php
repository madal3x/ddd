<?php

namespace common\domain\model;

interface DomainEventSubscriber {
    public function handleEvent(DomainEvent $event);
}