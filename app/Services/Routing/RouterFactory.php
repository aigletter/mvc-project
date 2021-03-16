<?php


namespace App\Services\Routing;


use Core\Contracts\FactoryAbstract;

/**
 * Class RouterFactory
 * Пример какой-то фабрики какого-то пользовательского сервиса
 *
 * @package App\Services\Routing
 */
class RouterFactory extends FactoryAbstract
{
    protected function createConcrete()
    {
        return new Router();
    }
}