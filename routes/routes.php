<?php

/**
 * @var \Core\Services\Routing\Router $this
 */

use App\Controllers\IndexController;
use App\Controllers\Invokable;

/**
 * Пример использования анонимной функции в качестве обработчика
 */
$this->addRoute('GET', '/test', function () {
    echo 'Function is running';
});

// Пример испоьзования экземпяра класса и его метода
// todo Создание экземпляров контроллеров нужно сделать динамически
$this->addRoute('GET', '/', [new IndexController(), 'index']);

// Пример использования invokable обьектов
// todo Создание экземпляров контроллеров нужно сделать динамически
$this->addRoute('GET', '/user', new Invokable());