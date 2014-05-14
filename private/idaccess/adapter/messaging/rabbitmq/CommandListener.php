<?php

namespace idaccess\adapter\messaging\rabbitmq;

use common\adapter\messaging\Exchanges;
use common\adapter\messaging\rabbitmq\ExchangeRRListener;
use idaccess\application\command\handler\factory\CommandHandlerFactory;

class CommandListener extends ExchangeRRListener {
    public function filteredDispatch($message) {
        $command = unserialize($message->body);

        $handlerFactory = new CommandHandlerFactory();
        $handler = $handlerFactory->createHandlerForCommand($command);
        $handler->execute($command);

        $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    }

    protected function exchangeName() {
        return Exchanges::IDACCESS_COMMAND_EXCHANGE;
    }
}