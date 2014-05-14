<?php

namespace common\domain\model;

interface DomainEvent {
    public function id();
    public function occurredOn();
}