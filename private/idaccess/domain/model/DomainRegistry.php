<?php

namespace idaccess\domain\model;

use idaccess\infrastructure\persistence\ConnectionFactory;
use idaccess\infrastructure\persistence\MySQLRoleRepository;
use idaccess\infrastructure\persistence\MySQLUserRepository;
use idaccess\infrastructure\service\MD5EncryptionService;
use idaccess\infrastructure\service\UniqIdAuthorizationTokenService;

class DomainRegistry {
    public function userRepository() {
        return new MySQLUserRepository(ConnectionFactory::create());
    }

    public function roleRepository() {
        return new MySQLRoleRepository(ConnectionFactory::create());
    }

    public function authenticationTokenService() {
        return new UniqIdAuthorizationTokenService();
    }

    public function encryptionService() {
        return new MD5EncryptionService();
    }
}