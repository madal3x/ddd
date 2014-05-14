<?php

namespace idaccess\infrastructure\persistence;

class ConnectionFactory {
    private static $instance;

    public static function create() {
        if ( ! isset(self::$instance)) {
            self::$instance = new \PDO('mysql:dbname=idaccess;host=127.0.0.1', 'root');
            self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}