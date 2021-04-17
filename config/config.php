<?php

use App\Services\Api\Api;
use App\Services\Auth\Auth;
use App\Services\Cache\Cache;
use App\Services\Cache\CacheFactory;
use App\Services\Routing\TestWriter;
use Core\Contracts\RouterInterface;
use Core\Services\Routing\RouterFactory;
use Logging\FileWriter;
use Logging\FormatterInterface;
use Logging\Logger;
use Logging\LoggerFactory;
use Logging\TextFormatter;
use Logging\WriterInterface;

// Для того чтобы подменить реализацию роутинга, например, можно указать другую фабрику
// Соответствено новый роутер должен реализовать соответствующий интерфейс
/*
use App\Services\Routing\RouterFactory;
use Core\Contracts\RouterInterface;
*/

return [
    // Массив привязок названий сервисов и фабрик, которые умеют их создавать
    'services' => [
        Cache::class => [
            'factory' => CacheFactory::class,
        ],
        'router' => [
            'factory' => RouterFactory::class,
        ],
        //\Logging\Logger::class => LoggerFactory::class,
        \Core\Services\Database\Db::class => [
            'factory' => \Core\Services\Database\DbFactory::class,
            'options' => [
                'dsn' => 'mysql:dbname=examples;host=127.0.0.1',
                'user' => 'root',
                'password' => '1q2w3e'
            ]
        ],
        Logger::class => [
            'class' => Logger::class
        ],
        WriterInterface::class => [
            /*'class' => TestWriter::class,
            'options' => [
                'test' => 'Hello world'
            ]*/
            'class' => FileWriter::class,
            'options' => [
                'file' => $_SERVER['DOCUMENT_ROOT'] . '/../storage/log.txt',
            ]
        ],
        FormatterInterface::class => [
            'class' => TextFormatter::class,
        ],
        'api' => [
            'class' => Api::class,
        ],
        Auth::class => [
            'class' => Auth::class
        ]
    ],
];