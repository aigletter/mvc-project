<?php

/**
 * @var \Core\Services\Routing\Router $this
 */

use App\Controllers\AuthController;
use App\Controllers\BankAccount;
use App\Controllers\IndexController;
use App\Controllers\Invokable;
use App\Controllers\UserController;

/**
 * Пример использования анонимной функции в качестве обработчика
 */
$this->addRoute('GET', '/test', function () {
    echo 'Function is running';
});

// Пример испоьзования экземпяра класса и его метода
// todo Создание экземпляров контроллеров нужно сделать динамически
$this->addRoute('GET', '/', [IndexController::class, 'index']);

// Пример использования invokable обьектов
// todo Создание экземпляров контроллеров нужно сделать динамически
$this->addRoute('GET', '/user', Invokable::class);

$this->addRoute('GET', '/user/view', [UserController::class, 'view']);
$this->addRoute('GET', '/user/edit', [UserController::class, 'edit']);
$this->addRoute('POST', '/user/update', [UserController::class, 'update']);

$this->addRoute('GET', '/auth/login', [AuthController::class, 'login']);
$this->addRoute('GET', '/bank/form', [BankAccount::class, 'form']);
$this->addRoute('GET', '/bank/withdrawal', [BankAccount::class, 'withdrawal']);