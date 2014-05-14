<?php

namespace common\adapter\http;

class Routes {
    /** @var Route[] */
    private $routes;

    public function __construct() {
        $this->routes = array();
    }

    public function add($uri, $class, $method, $requiresAuthentication = true, $isAuthentication = false) {
        $this->routes[] = new Route($uri, $class, $method, $requiresAuthentication, $isAuthentication);
    }

    public function getLoginRoute() {
        foreach ($this->routes as $route) {
            if ($route->isAuthentication()) {
                return $route;
            }
        }

        return null;
    }

    public function getByUri($uri) {
        foreach ($this->routes as $route) {
            if ($route->uri() === $uri) {
                return $route;
            }
        }

        return null;
    }
}