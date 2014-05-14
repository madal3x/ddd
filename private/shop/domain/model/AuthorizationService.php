<?php

namespace shop\domain\model;

class AuthorizationService {
    private $tokenRepository;
    private $tokenValiditySpecification;

    public function __construct(TokenRepository $tokenRepository, TokenValiditySpecification $tokenValiditySpecification) {
        $this->tokenRepository = $tokenRepository;
        $this->tokenValiditySpecification = $tokenValiditySpecification;
    }

    public function isTokenAuthorized($token) {
        $token = $this->tokenRepository->getByToken($token);

        if ($token && $token->isValid($this->tokenValiditySpecification)) {
            return true;
        }

        return false;
    }
}