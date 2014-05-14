<?php

namespace idaccess\domain\model;

interface RoleRepository {
    /**
     * @param $userId
     * @return Role
     */
    public function getByUserIdAndRoleName($userId, $roleName);
}