<?php

namespace idaccess\domain\model;

use common\domain\model\Entity;

class User extends Entity {
    private $username;
    private $password;

    protected function __constructor() {

    }

    public static function initializeNew($username, $password) {
        $user = new User();
        $user->initializeCredentials($username, $password);
        $user->setId();

        return $user;
    }

    public static function initializeExisting($id, $username, $password) {
        $user = new User();
        $user->initializeCredentials($username, $password);
        $user->setId($id);

        return $user;
    }

    public function username() {
        return $this->username;
    }

    protected function password() {
        return $this->password;
    }

    protected function initializeCredentials($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
}