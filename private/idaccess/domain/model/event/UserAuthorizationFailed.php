<?php

namespace idaccess\domain\model\event;

use common\domain\model\DomainEvent;

class UserAuthorizationFailed implements DomainEvent {
    private $id;
    private $occurredOn;
    private $username;
    private $roleName;

    public function __construct($username, $roleName) {
        $this->setId();
        $this->setOccurredOn(new \DateTime());
        $this->setUsername($username);
        $this->setRoleName($roleName);
    }

    public function id() {
        return $this->id;
    }

    public function occurredOn() {
        return $this->occurredOn;
    }

    public function username() {
        return $this->username;
    }

    public function roleName() {
        return $this->roleName;
    }

    protected function setId() {
        $this->id = uniqid();
    }

    protected function setUsername($username) {
        $this->username = $username;
    }

    protected function setRoleName($roleName) {
        $this->roleName = $roleName;
    }

    protected function setOccurredOn(\DateTime $occurredOn) {
        $this->occurredOn = $occurredOn;
    }
}