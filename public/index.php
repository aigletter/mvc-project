<?php

/**
 * Точка входа приложения
 */


use Core\Application;

ini_set('display_errors', 1);

require_once '../vendor/autoload.php';


$config = include '../config/config.php';

$app = Application::getInstance();
$app->initialize($config);
$app->run();