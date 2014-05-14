<?php

namespace idaccess\infrastructure\persistence;

use common\persistence\MySQLRepository;
use idaccess\domain\model\Role;
use idaccess\domain\model\RoleRepository;

class MySQLRoleRepository extends MySQLRepository implements RoleRepository {
    public function getByRoleName($roleName) {
        $s = $this->db->prepare(
            "SELECT
               *
             FROM
               role
             WHERE
               role_name = ?
             LIMIT 1"
        );

        $s->execute(array(
            $roleName
        ));

        $result = $s->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->map($result);
        }

        return null;
    }

    public function getByUserIdAndRoleName($userId, $roleName) {
        $s = $this->db->prepare(
            "SELECT
               role.*
             FROM
               role
             INNER JOIN
               role_user
             ON
               role.id = role_user.role_id
             AND
               role_user.user_id = ?
             WHERE
               role.role_name = ?
             LIMIT 1"
        );

        $s->execute(array(
            $userId,
            $roleName
        ));

        $result = $s->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->map($result);
        }

        return null;
    }

    protected function map($result) {
        return Role::initializeExisting($result['id'], $result['role_name']);
    }
}