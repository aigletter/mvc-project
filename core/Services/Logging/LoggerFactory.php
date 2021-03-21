<?php


namespace Logging;


class LoggerFactory extends \Core\Contracts\FactoryAbstract
{
    protected function createConcrete()
    {
        $writer = new \Logging\DbWriter();
        $formatter = new \Logging\JsonFormatter();
        $logger = new Logger($writer, $formatter);

        return $logger;
    }
}