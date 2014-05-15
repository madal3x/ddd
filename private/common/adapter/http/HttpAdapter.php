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

        if ($route) {
            if ($route->requiresAuthentication() && ! $httpRequest->isUserLogged()) {
                if ($loginRoute) {
                    $httpResponse->redirect($loginRoute->uri());
                } else {
                    throw new \Exception("There is no authentication route defined.");
                }
            } else {
                $className = $route->className();
                $methodName = $route->methodName();

                $class = new $className();
                try {
                    $class->$methodName($httpRequest, $httpResponse);
                } catch (SecurityException $e) {
                    if ($loginRoute) {
                        $httpResponse->redirect($loginRoute->uri());
                    } else {
                        throw new \Exception("There is no authentication route defined.");
                    }
                }
            }

            return true;
        }

        return false;
    }
}