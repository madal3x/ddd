<?php

namespace idaccess\domain\model\event;

use common\domain\model\DomainEvent;

class UserAuthorizationSucceeded implements DomainEvent {
    private $id;
    private $occurredOn;
    private $username;
    private $roleName;
    private $token;

    public function __construct($username, $roleName, $token) {
        $this->setId();
        $this->setOccurredOn(new \DateTime());
        $this->setUsername($username);
        $this->setRoleName($roleName);
        $this->setToken($token);
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

    public function token() {
        return $this->token;
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

    protected function setToken($token) {
        $this->token = $token;
    }

    protected function setOccurredOn(\DateTime $occurredOn) {
        $this->occurredOn = $occurredOn;
    }
}