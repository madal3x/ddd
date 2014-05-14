<?php

namespace idaccess\infrastructure\service;

use idaccess\domain\model\AuthorizationTokenService;

class UniqIdAuthorizationTokenService implements AuthorizationTokenService {
    public function generate() {
        return uniqid('idaccess_', true);
    }
}