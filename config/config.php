<?php

use App\Services\Cache\Cache;
use App\Services\Cache\CacheFactory;
use Core\Contracts\RouterInterface;
use Core\Services\Routing\RouterFactory;
use Logging\LoggerFactory;

// Для того чтобы подменить реализацию роутинга, например, можно указать другую фабрику
// Соответствено новый роутер должен реализовать соответствующий интерфейс
/*
use App\Services\Routing\RouterFactory;
use Core\Contracts\RouterInterface;
*/

return [
    // Массив привязок названий сервисов и фабрик, которые умеют их создавать
    'services' => [
        Cache::class => CacheFactory::class,
        'router' => [
            'factory' => RouterFactory::class,
        ],
        \Logging\Logger::class => LoggerFactory::class,
        \Core\Services\Database\Db::class => [
            'factory' => \Core\Services\Database\DbFactory::class,
            'options' => [
                'dsn' => 'mysql:dbname=examples;host=127.0.0.1',
                'user' => 'root',
                'password' => '1q2w3e'
            ]
        ]
    ],
];