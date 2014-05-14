<?php

namespace common\domain\model;

abstract class Entity {
    private $id;

    public function id() {
        return $this->id;
    }

    protected function setId($id = null) {
        if ($id === null) {
            $this->id = uniqid();
        } else {
            $this->id = $id;
        }
    }
}