<?php

use App\Services\Cache\Cache;
use App\Services\Cache\CacheFactory;
use Core\Contracts\RouterInterface;
use Core\Services\Routing\RouterFactory;

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
        RouterInterface::class => RouterFactory::class,
    ],
];