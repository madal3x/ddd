<?php

namespace common\adapter\http;

class HttpAdapterChain {
    private $adapters;

    public function __construct() {
        $this->adapters = array();
    }

    public function add(HttpAdapter $adapter) {
        $this->adapters[] = $adapter;
    }

    /**
     * Stops execution when a HttpAdapter has found a route, returning true
     */
    public function execute() {
        foreach ($this->adapters as $adapter) {
            /** @var $adapter HttpAdapter */
            if ($adapter->execute()) {
                break;
            }
        }
    }
}