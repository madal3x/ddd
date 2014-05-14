<?php

namespace shop\adapter\service;

interface UserInRoleAdapter {
    public function authorize($username, $password, $roleName);
}