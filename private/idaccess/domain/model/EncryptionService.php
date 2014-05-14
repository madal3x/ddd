<?php

namespace idaccess\domain\model;

interface EncryptionService {
    public function encrypt($plainTextValue);
}