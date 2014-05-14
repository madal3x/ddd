<?php

namespace common\adapter\http;

use common\domain\model\SecurityException;

abstract class HttpAdapter {
    /** @var \common\adapter\http\Routes */
    protected $routes;

    abstract public function __construct();

    protected function setRoutes(Routes $routes) {
        $this->routes = $routes;
    }

    public function execute() {
        $httpRequest = new HttpRequest();
        $httpResponse = new HttpResponse();
        $route = $this->routes->getByUri($httpRequest->uri());
        $loginRoute = $this->routes->getLoginRoute();

        if ( ! $route) {
            throw new \Exception("Could not find route for uri: ".$httpRequest->uri());
        }

        if ($route->requiresAuthentication() && ! $httpRequest->isUserLogged()) {
            $httpResponse->redirect($loginRoute->uri());
        } else {
            $className = $route->className();
            $methodName = $route->methodName();

            $class = new $className();
            try {
                $class->$methodName($httpRequest, $httpResponse);
            } catch (SecurityException $e) {
                $httpResponse->redirect($loginRoute->uri());
            }
        }
    }
}