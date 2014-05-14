<?php

class Autoloader {
    static public function loader($className) {
        $fileName = dirname(__FILE__)."/" . str_replace("\\", "/", $className) . ".php";

        if (strpos($className, 'PhpAmqpLib') !== false) {
            $fileName = dirname(__FILE__)."/vendor/php-amqplib/" . str_replace("\\", "/", $className) . ".php";
        }

        if (file_exists($fileName)) {
            require_once($fileName);

            if (class_exists($className)) {
                return true;
            }
        }

        return false;
    }
}

spl_autoload_register('Autoloader::loader');