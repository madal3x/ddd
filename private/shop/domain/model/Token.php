<?php

namespace shop\domain\model;

class Token {
    private $token;
    private $createdOn;
    private $lastUsedOn;

    public function __construct($token, \DateTime $createdOn, \DateTime $lastUsedOn) {
        $this->setToken($token);
        $this->setCreatedOn($createdOn);
        $this->setLastUsedOn($lastUsedOn);
    }

    public function isValid(TokenValiditySpecification $specification) {
        if ($specification->isSatisfiedBy($this)) {
            return true;
        }

        return false;
    }

    public function token() {
        return $this->token;
    }

    /**
     * @return \DateTime
     */
    public function createdOn() {
        return $this->createdOn;
    }

    /**
     * @return \DateTime
     */
    public function lastUsedOn() {
        return $this->lastUsedOn;
    }

    protected function setToken($token) {
        $this->token = $token;
    }

    protected function setCreatedOn(\DateTime $createdOn) {
        $this->createdOn = $createdOn;
    }

    protected function setLastUsedOn(\DateTime $lastUsedOn) {
        $this->lastUsedOn = $lastUsedOn;
    }
}