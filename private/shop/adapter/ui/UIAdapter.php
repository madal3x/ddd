<?php

namespace shop\adapter\ui;

use common\adapter\http\HttpAdapter;
use common\adapter\http\Routes;

class UIAdapter extends HttpAdapter {
    public function __construct() {
        $routes = new Routes();
        $routes->add(
            '/shop/customer/login',
            '\\shop\\adapter\\ui\\controller\\CustomerController',
            'login',
            false,
            true
        );
        $routes->add(
            '/shop/customer/home',
            '\\shop\\adapter\\ui\\controller\\CustomerController',
            'home'
        );
        $routes->add(
            '/shop/customer/logout',
            '\\shop\\adapter\\ui\\controller\\CustomerController',
            'logout'
        );

        $this->setRoutes($routes);
    }
}