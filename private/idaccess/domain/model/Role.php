<?php

namespace idaccess\domain\model;

use common\domain\model\Entity;

class Role extends Entity {
    private $name;

    protected function __construct() {

    }

    public static function initializeNew($name) {
        $role = new Role();
        $role->setName($name);
        $role->setId();

        return $role;
    }

    public static function initializeExisting($id, $name) {
        $role = new Role();
        $role->setName($name);
        $role->setId($id);

        return $role;
    }

    public function name() {
        return $this->name;
    }

    private function setName($name) {
        $this->name = $name;
    }
}