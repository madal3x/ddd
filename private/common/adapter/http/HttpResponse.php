<?php

namespace common\adapter\http;

class HttpResponse {
    public function redirect($uri) {
        header("Location: ".$uri);

        exit;
    }
}