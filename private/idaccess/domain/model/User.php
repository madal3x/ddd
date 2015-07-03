<?php

namespace idaccess\domain\model;

use common\domain\model\Entity;

class User extends Entity {
    private $username;
    private $password;

    public function __constructor($username, $password, $id = null) {
        $this->setCredentials($username, $password);
        $this->setId($id);

        return $this;
    }

    public function username() {
        return $this->username;
    }

    protected function password() {
        return $this->password;
    }

    protected function setCredentials($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}