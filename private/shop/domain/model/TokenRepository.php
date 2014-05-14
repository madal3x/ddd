<?php

namespace shop\domain\model;

interface TokenRepository {
    /**
     * @param $token
     * @return Token
     */
    public function getByToken($token);
    public function save(Token $token);
}