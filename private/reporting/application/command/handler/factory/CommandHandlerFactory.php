<?php

namespace reporting\application\command\handler\factory;

use common\domain\model\Command;
use reporting\application\command\handler\SubmitAuthorizationReportCommandHandler;
use reporting\domain\model\DomainRegistry;

class CommandHandlerFactory {
    private $domainRegistry;

    public function __construct() {
        $this->domainRegistry = new DomainRegistry();
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

        return $this->$factoryMethod();
    }

    protected function submitAuthorizationReportCommandHandler() {
        return new SubmitAuthorizationReportCommandHandler($this->domainRegistry->reportService());
    }
}