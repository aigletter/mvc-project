<?php


namespace App\Services\Cache;


/**
 * Class CacheFactory
 * Пример какой-то фабрики какого-то пользовательского сервиса
 *
 * @package App\Services\Cache
 */
class CacheFactory extends \Core\Contracts\FactoryAbstract
{
    protected function createConcrete()
    {
        $filename = 'data/cache.txt';
        return new Cache($filename);
    }
}