<?php

namespace idaccess\application\command;

use common\domain\model\Command;

class AuthorizeUserCommand implements Command {
    private $username;
    private $password;
    private $roleName;

    public function __construct($username, $password, $roleName) {
        $this->setUsername($username);
        $this->setRoleName($roleName);
        $this->setPassword($password);
    }

    /**
     * @return mixed
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function password()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function roleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $roleName
     */
    private function setRoleName($roleName)
    {
        $this->roleName = $roleName;
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
     * @param mixed $password
     */
    private function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}