<?php

namespace shop\application\command\handler\factory;

use common\adapter\messaging\rabbitmq\ConnectionFactory;
use common\domain\model\Command;
use shop\adapter\messaging\rabbitmq\IdAccessCommandPublisher;
use shop\adapter\service\RabbitMQUserInRoleAdapter;
use shop\application\command\handler\LoginCustomerCommandHandler;
use shop\application\command\handler\SecurityCommandHandler;
use shop\domain\model\DomainRegistry;

class CommandHandlerFactory {
    private $domainRegistry;

    public function __construct(DomainRegistry $domainRegistry) {
        $this->domainRegistry = $domainRegistry;
    }

    /**
     * @param $command
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

        return new SecurityCommandHandler($this->$factoryMethod(), $this->domainRegistry->authorizationService());
    }

    /**
     * @return LoginCustomerCommandHandler
     */
    protected function loginCustomerCommandHandler() {
        return new LoginCustomerCommandHandler(
            new RabbitMQUserInRoleAdapter(
                ConnectionFactory::create(),
                new IdAccessCommandPublisher(ConnectionFactory::create())
            )
        );
    }
}