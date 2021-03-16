<?php


namespace App\Controllers;


use App\Services\Routing\Router;

/**
 * Class IndexController
 * Пример контроллера
 *
 * @package App\Controllers
 */
class IndexController
{
    public function index()
    {
        echo 'Run index method index controller';
    }

    public function user()
    {
        echo 'User method';
    }
}