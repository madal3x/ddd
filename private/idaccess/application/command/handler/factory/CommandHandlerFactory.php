<?php

namespace idaccess\application\command\handler\factory;

use common\adapter\messaging\rabbitmq\ConnectionFactory;
use common\domain\model\Command;
use common\domain\model\DomainEventPublisher;
use idaccess\adapter\messaging\rabbitmq\EventPublisher;
use idaccess\application\command\handler\AuthorizeUserCommandHandler;
use idaccess\domain\model\AuthorizationService;
use idaccess\domain\model\DomainRegistry;

class CommandHandlerFactory {
    private $domainRegistry;

    public function __construct() {
        $this->domainRegistry = new DomainRegistry();
    }

    /**
     * @param Command $command
     * @return \common\domain\model\CommandHandler
     * @throws \Exception
     */
    public function createHandlerForCommand(Command $command) {
        $list = explode("\\", get_class($command));
        $className = $list[count($list) - 1];
        $factoryMethod = lcfirst($className).'Handler';

        if ( ! method_exists($this, $factoryMethod)) {
            throw new \Exception("Could not find factory method for command class: ".$className);
        }

        return $this->$factoryMethod();
    }

    /**
     * @return AuthorizeUserCommandHandler
     */
    protected function authorizeUserCommandHandler() {
        $domainEventPublisher = new DomainEventPublisher(new EventPublisher(ConnectionFactory::create()));
        $authorizationService = new AuthorizationService(
            $this->domainRegistry->userRepository(),
            $this->domainRegistry->roleRepository(),
            $this->domainRegistry->encryptionService(),
            $this->domainRegistry->authenticationTokenService(),
            $domainEventPublisher
        );

        return new AuthorizeUserCommandHandler($authorizationService);
    }
}