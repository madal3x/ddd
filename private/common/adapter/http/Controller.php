<?php

namespace common\adapter\http;

abstract class Controller {
    public function redirect($url) {
        header("Location: ".$url);

        exit;
    }
}