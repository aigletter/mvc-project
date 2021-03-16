<?php


namespace App\Controllers;


use App\Services\Cache\Cache;
use Core\Application;

/**
 * Class Invokable
 * Пример invokable класса
 *
 * @package App\Controllers
 */
class Invokable
{
    public function __invoke()
    {
        // Пример получения экземпляра сервиса из контейнера
        // Не самая лучшая реализация. Но мы это исправим в дальнейшем
        $cache = Application::getInstance()->get(Cache::class);
        $filename = $cache->getFilename();
        echo $filename;

        // Пример получения уже существующего экземпляра
        $cache2 = Application::getInstance()->get(Cache::class);
    }
}