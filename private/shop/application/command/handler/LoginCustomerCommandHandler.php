<?php

namespace shop\application\command\handler;

use common\domain\model\CommandHandler;
use shop\adapter\service\UserInRoleAdapter;
use shop\application\command\LoginCustomerCommand;

class LoginCustomerCommandHandler implements CommandHandler {
    private $userInRoleAdapter;

    public function __construct(UserInRoleAdapter $userInRoleAdapter) {
        $this->userInRoleAdapter = $userInRoleAdapter;
    }

    public function execute(LoginCustomerCommand $command) {
        if ($token = $this->userInRoleAdapter->authorize($command->username(), $command->password(), 'customer')) {
            var_dump($token);

            return $token;
        }

        return false;
    }
}