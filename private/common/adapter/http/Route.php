<?php

namespace common\adapter\http;

class Route {
    private $uri;
    private $className;
    private $methodName;
    private $requiresAuthentication;
    private $isAuthentication;

    public function __construct($uri, $class, $method, $requiresAuthentication = true, $isAuthentication = false) {
        if ( ! class_exists($class)) {
            throw new \Exception("The route could not find the class: ".$class);
        }

        if ( ! method_exists($class, $method)) {
            throw new \Exception("Could not find method $method in class $class.");
        }

        $this->uri = $uri;
        $this->className = $class;
        $this->methodName = $method;
        $this->requiresAuthentication = $requiresAuthentication;
        $this->isAuthentication = $isAuthentication;
    }

    public function requiresAuthentication() {
        return $this->requiresAuthentication;
    }

    public function uri() {
        return $this->uri;
    }

    public function className() {
        return $this->className;
    }

    public function methodName() {
        return $this->methodName;
    }

    public function isAuthentication() {
        return $this->isAuthentication;
    }
}