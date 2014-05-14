<?php

require_once dirname(__FILE__).'/../../../private/Autoloader.php';

$listener = \reporting\adapter\messaging\rabbitmq\factory\UserEventListenerFactory::create();