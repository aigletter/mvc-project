<?php

/**
 * Точка входа приложения
 */


use Core\Application;

require_once '../vendor/autoload.php';


$config = include '../config/config.php';

$app = Application::getInstance();
$app->initialize($config);
$app->run();