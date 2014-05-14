<?php

namespace shop\domain\model;

use shop\infrastructure\persistence\MySQLTokenRepository;
use shop\infrastructure\persistence\ConnectionFactory;

class DomainRegistry {
    public function authorizationService() {
        return new AuthorizationService(
            new MySQLTokenRepository(ConnectionFactory::create()),
            new TokenValiditySpecification(60)
        );
    }
}