<?php

namespace idaccess\domain\model;

use common\domain\model\Entity;

class Role extends Entity {
    private $name;

    public function __construct($name, $id = null) {
        $this->setId($id);
        $this->setName($name);

        return $this;
    }

    public function name() {
        return $this->name;
    }

    private function setName($name) {
        $this->name = $name;
    }
}