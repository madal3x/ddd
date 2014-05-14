<?php

namespace shop\adapter\ui\controller;

use common\adapter\http\Controller;
use common\adapter\http\HttpRequest;
use common\adapter\http\HttpResponse;
use shop\application\command\handler\factory\CommandHandlerFactory;
use shop\application\command\LoginCustomerCommand;
use shop\domain\model\DomainRegistry;

class CustomerController extends Controller {
    private $commandHandlerFactory;

    public function __construct() {
        $this->commandHandlerFactory = new CommandHandlerFactory(new DomainRegistry());
    }

    public function login(HttpRequest $request, HttpResponse $response) {
        if ($request->isUserLogged()) {
            $response->redirect('/shop/customer/home');
        }

        if ($username = $request->post('username')) {
            $command = new LoginCustomerCommand($username, $request->post('password'));
            $commandHandler = $this->commandHandlerFactory->createHandlerForCommand($command);
            if ($token = $commandHandler->execute($command)) {
                $request->loginUser($token, $username);

                $response->redirect('/shop/customer/home');
            } else {
                $response->redirect('/shop/customer/login?msg=login_failed');
            }
        } else {
            require_once dirname(__FILE__) . '/../view/template/login.tpl.php';
        }
    }

    public function logout(HttpRequest $request, HttpResponse $response) {
        $request->logoutUser();
        $response->redirect('/shop/customer/login');
    }

    public function home(HttpRequest $request, HttpResponse $response) {
        require_once dirname(__FILE__) . '/../view/template/home.tpl.php';
    }
}