<?php


namespace App\Services\Routing;


use Core\Contracts\RouterInterface;

/**
 * Class Router
 * Пример какого-то полезного сервиса
 * Реализуем интерфейс роутера и можем им подменить стандартный роутер
 *
 * @package App\Services\Routing
 */
class Router implements RouterInterface
{
    public function route(): callable
    {
        if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === '/') {
            return function() {
                echo 'Hello world';
            };
        }

        throw new \Exception('Can not');
    }
}