<?php

namespace idaccess\application\command\handler;

use idaccess\application\command\AuthorizeUserCommand;
use idaccess\domain\model\AuthorizationService;

class AuthorizeUserCommandHandler {
    /** @var \idaccess\domain\model\AuthorizationService  */
    private $authorizationService;

    public function __construct(AuthorizationService $authorizationService) {
        $this->authorizationService = $authorizationService;
    }

    public function execute(AuthorizeUserCommand $command) {
        return $this->authorizationService->authorize($command->username(), $command->password(), $command->roleName());
    }
}