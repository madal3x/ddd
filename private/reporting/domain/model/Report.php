<?php

namespace reporting\domain\model;

use common\domain\model\Entity;

class Report extends Entity {
    protected $type;
    protected $username;
    protected $roleName;
    protected $status;
    protected $dateCreated;

    public static function authentication($username, $status, \DateTime $dateCreated) {
        return new Report('authentication', $username, $status, $dateCreated);
    }

    public static function authorization($username, $roleName, $status, \DateTime $dateCreated) {
        return new Report('authorization', $username, $status, $dateCreated, $roleName);
    }

    public function type() {
        return $this->type;
    }

    public function username() {
        return $this->username;
    }

    public function roleName() {
        return $this->roleName;
    }

    public function status() {
        return $this->status;
    }

    /**
     * @return \DateTime
     */
    public function dateCreated() {
        return $this->dateCreated;
    }

    protected function __construct($type, $username, $status, $dateCreated, $roleName = '') {
        $this->setId();
        $this->setType($type);
        $this->setUsername($username);
        $this->setStatus($status);
        $this->setRoleName($roleName);
        $this->setDateCreated($dateCreated);
    }

    /**
     * @param mixed $roleName
     */
    protected function setRoleName($roleName)
    {
        $this->roleName = $roleName;
        return $this;
    }

    /**
     * @param \DateTime $dateCreated
     */
    protected function setDateCreated(\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @param mixed $status
     */
    protected function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param mixed $type
     */
    protected function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param mixed $username
     */
    protected function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}