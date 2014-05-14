<?php

require_once dirname(__FILE__).'/../../../private/Autoloader.php';

$commandListener = \idaccess\adapter\messaging\rabbitmq\factory\CommandListenerFactory::create();