<?php

use Logging\Logger;

ini_set('display_errors', '1');
include "../vendor/autoload.php";

$fileWriter = new \Logging\FileWriter('text.log');
$dbWriter = new \Logging\DbWriter();

$formatter = new \Logging\TextFormatter();

$writer = $fileWriter;


// ...


if (true) {
    $writer = $dbWriter;
    $formatter = new \Logging\JsonFormatter();
}

$logger = new Logger($writer, $formatter);
$logger->debug('Hello', [
    'test' => 'Hello',
    'Blablabla'
]);

exit();