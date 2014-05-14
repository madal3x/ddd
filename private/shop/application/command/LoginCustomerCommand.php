<?php

namespace shop\application\command;

use common\domain\model\Command;

class LoginCustomerCommand implements Command {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->setUsername($username);
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
     * @param mixed $password
     */
    protected function setPassword($password)
    {
        $this->password = $password;
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