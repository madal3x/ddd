<?php

namespace shop\adapter\service;

use common\adapter\messaging\Exchanges;
use common\adapter\messaging\rabbitmq\ExchangeTopicListener;
use idaccess\application\command\AuthorizeUserCommand;
use idaccess\domain\model\event\UserAuthorizationSucceeded;
use PhpAmqpLib\Connection\AMQPConnection;
use shop\adapter\messaging\rabbitmq\IdAccessCommandPublisher;

class RabbitMQUserInRoleAdapter extends ExchangeTopicListener implements UserInRoleAdapter {
    private $idAccessCommandPublisher;
    private $username;
    private $authorizationToken;
    private $authorized;

    public function __construct(AMQPConnection $connection, IdAccessCommandPublisher $idAccessCommandPublisher) {
        $this->connection = $connection;
        $this->idAccessCommandPublisher = $idAccessCommandPublisher;
    }

    public function authorize($username, $password, $roleName) {
        $this->username = $username;

        $this->attachToQueue();

        $this->idAccessCommandPublisher->publish(new AuthorizeUserCommand($username, $password, $roleName));

        $this->listen();

        if ($this->authorized) {
            return $this->authorizationToken;
        }

        return false;
    }

    public function filteredDispatch($message) {
        $event = unserialize($message->body);

        if ($event->username() == $this->username) {
            if ($event instanceof UserAuthorizationSucceeded) {
                $this->authorized = true;
                $this->authorizationToken = $event->token();
            }

            $this->detachFromQueue();
        }
    }

    protected function listensTo() {
        return array(
            'idaccess\\domain\\model\\event\\UserAuthorizationFailed',
            'idaccess\\domain\\model\\event\\UserAuthorizationSucceeded'
        );
    }

    protected function exchangeName() {
        return Exchanges::IDACCESS_EVENT_EXCHANGE;
    }
}