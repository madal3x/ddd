<?php

namespace reporting\application\command;

use common\domain\model\Command;

class SubmitAuthorizationReportCommand implements Command {
    private $username;
    private $roleName;
    private $status;
    private $dateCreated;

    public function __construct($username, $roleName, $status, $dateCreated) {
        $this->setUsername($username);
        $this->setRoleName($roleName);
        $this->setStatus($status);
        $this->setDateCreated($dateCreated);
    }

    /**
     * @return mixed
     */
    public function status()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @return \DateTime
     */
    public function dateCreated() {
        return $this->dateCreated;
    }

    /**
     * @return mixed
     */
    public function roleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $status
     */
    private function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param \DateTime $dateCreated
     */
    private function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @param mixed $username
     */
    private function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param mixed $roleName
     */
    private function setRoleName($roleName)
    {
        $this->roleName = $roleName;
        return $this;
    }
}