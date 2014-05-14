<?php

namespace shop\application\command\handler;

use common\domain\model\Command;
use common\domain\model\CommandHandler;
use common\domain\model\SecurityException;
use shop\domain\model\AuthorizationService;

class SecurityCommandHandler {
    private $commandHandler;
    private $authorizationService;

    private $commandWhitelist = array(
        'shop\\application\\command\\LoginCustomerCommand'
    );

    public function __construct(CommandHandler $commandHandler, AuthorizationService $authorizationService) {
        $this->commandHandler = $commandHandler;
        $this->authorizationService = $authorizationService;
    }

    public function execute(Command $command) {
        if ( ! $this->isAuthorizedFor($command)) {
            throw new SecurityException("You are not allowed to execute command: ".get_class($command));
        }

        return $this->commandHandler->execute($command);
    }

    private function isAuthorizedFor(Command $command) {
        if (in_array(get_class($command), $this->commandWhitelist)) {
            return true;
        }

        if ( ! method_exists($command, 'token')) {
            throw new \RuntimeException("The command which requires authorization needs to have a token.");
        }

        if ($this->authorizationService->isTokenAuthorized($command->token())) {
            return true;
        }

        return false;
    }
}