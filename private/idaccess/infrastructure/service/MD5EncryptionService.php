<?php

namespace idaccess\infrastructure\service;

use idaccess\domain\model\EncryptionService;

class MD5EncryptionService implements EncryptionService {
    public function encrypt($plainTextValue) {
        return md5($plainTextValue);
    }
}