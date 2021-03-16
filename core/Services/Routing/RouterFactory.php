<?php


namespace Core\Services\Routing;


use Core\Contracts\FactoryAbstract;

/**
 * Class RouterFactory
 * Реализация фабричного метода, которая создает конкретный экзепляр
 *
 * @package Core\Services\Routing
 */
class RouterFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        return new Router();
    }
}