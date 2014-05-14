<?php

namespace reporting\adapter\messaging\rabbitmq;

use common\adapter\messaging\Exchanges;
use common\adapter\messaging\rabbitmq\ExchangeTopicListener;
use idaccess\domain\model\event\UserAuthorizationFailed;
use idaccess\domain\model\event\UserAuthorizationSucceeded;
use reporting\application\command\handler\factory\CommandHandlerFactory;
use reporting\application\command\SubmitAuthorizationReportCommand;

class UserEventListener extends ExchangeTopicListener {
    public function filteredDispatch($message) {
        $event = unserialize($message->body);

        $commandHandlerFactory = new CommandHandlerFactory();
        if ($event instanceof UserAuthorizationFailed) {
            $command = new SubmitAuthorizationReportCommand($event->username(), $event->roleName(), 'failed', $event->occurredOn());
        } elseif ($event instanceof UserAuthorizationSucceeded) {
            $command = new SubmitAuthorizationReportCommand($event->username(), $event->roleName(), 'succeeded', $event->occurredOn());
        }

        if (isset($command)) {
            $handler = $commandHandlerFactory->createHandlerForCommand($command);
            $handler->execute($command);
        }
    }

    protected function exchangeName() {
        return Exchanges::IDACCESS_EVENT_EXCHANGE;
    }

    protected function listensTo() {
        return array(
            'idaccess\\domain\\model\\event\\UserAuthorizationFailed',
            'idaccess\\domain\\model\\event\\UserAuthorizationSucceeded'
        );
    }
}