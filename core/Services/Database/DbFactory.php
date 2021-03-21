<?php


namespace Core\Services\Database;


use Core\Contracts\FactoryAbstract;

class DbFactory extends FactoryAbstract
{

    protected function createConcrete()
    {
        return new Db($this->options['dsn'], $this->options['user'], $this->options['password']);
    }
}