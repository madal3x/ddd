<?php

require_once(dirname(__FILE__)."/../private/Autoloader.php");

$adapterChain = new \common\adapter\http\HttpAdapterChain();
$adapterChain->add(new \shop\adapter\ui\UIAdapter());
$adapterChain->execute();