<?php

namespace common\adapter\http;

class HttpRequest {
    private $uri;
    private $get;
    private $post;
    private $file;
    private $session;

    public function __construct() {
        $this->initUri();
        $this->initGet();
        $this->initPost();
        $this->initFile();
        $this->initSession();
    }

    public function loginUser($token, $username) {
        session_regenerate_id();
        $this->setSessionVar('token', $token);
        $this->setSessionVar('username', $username);
    }

    public function logoutUser() {
        session_destroy();
    }

    public function isUserLogged() {
        return $this->session('token') ? true : false;
    }

    public function userToken() {
        return $this->session('token');
    }

    public function username() {
        return $this->session('username');
    }

    public function get($name) {
        return isset($this->get[$name]) ? $this->get[$name] : null;
    }

    public function post($name) {
        return isset($this->post[$name]) ? $this->post[$name] : null;
    }

    public function session($name) {
        return isset($this->session[$name]) ? $this->session[$name] : null;
    }

    public function file($name) {
        return isset($this->file[$name]) ? $this->file[$name] : null;
    }

    public function uri() {
        return $this->uri;
    }

    public function setSessionVar($name, $value) {
        $this->session[$name] = $value;
        $_SESSION[$name] = $value;
    }

    protected function initUri() {
        $uriParts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $uri = preg_replace("/\/$/", "", $uriParts[0]);

        $this->uri = $uri;
    }

    protected function initGet() {
        $this->get = array_merge(array(), $_GET);
    }

    protected function initPost() {
        $this->post = array_merge(array(), $_POST);
    }

    protected function initFile() {
        $this->file = array_merge(array(), $_FILES);
    }

    protected function initSession() {
        @session_start();

        $this->session = array_merge(array(), $_SESSION);
    }
}