<?php

namespace idaccess\domain\model;

interface UserRepository {
    /**
     * @param $username
     * @param $encPassword
     * @return User
     */
    public function getByUsernameAndPassword($username, $encPassword);

    /**
     * @param $username
     * @return User
     */
    public function getByUsername($username);
}