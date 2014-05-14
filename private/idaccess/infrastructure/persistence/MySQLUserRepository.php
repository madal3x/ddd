<?php

namespace idaccess\infrastructure\persistence;

use common\persistence\MySQLRepository;
use idaccess\domain\model\User;
use idaccess\domain\model\UserRepository;

class MySQLUserRepository extends MySQLRepository implements UserRepository {
    public function getByUsernameAndPassword($username, $password) {
        $s = $this->db->prepare(
            "SELECT
               *
             FROM
               user
             WHERE
               username = ?
             AND
               password = ?
             LIMIT 1"
        );

        $s->execute(array(
            $username,
            $password
        ));

        $result = $s->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->map($result);
        }

        return null;
    }

    public function getByUsername($username) {
        $s = $this->db->prepare(
            "SELECT
               *
             FROM
               user
             WHERE
               username = ?
             LIMIT 1"
        );

        $s->execute(array(
            $username
        ));

        $result = $s->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->map($result);
        }

        return null;
    }

    protected function map($result) {
        return User::initializeExisting($result['id'], $result['username'], $result['password']);
    }
}