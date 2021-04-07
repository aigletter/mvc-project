<?php


namespace Logging;


class LoggerFactory extends \Core\Contracts\FactoryAbstract
{
    protected function createConcrete()
    {
        $writer = new FileWriter($_SERVER['DOCUMENT_ROOT'] . '/../storage/log.txt');
        $formatter = new TextFormatter();
        $logger = new Logger($writer, $formatter);

        return $logger;
    }
}