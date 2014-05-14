<?php

namespace common\persistence;

abstract class MySQLRepository {
    protected $db;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }
}