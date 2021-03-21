<?php


namespace App\Controllers;


use App\Services\Routing\Router;
use Core\Application;
use Core\Services\Database\Db;
use Core\Services\Database\Query;
use Logging\Logger;

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
        $logger = Application::getInstance()->get(Logger::class);
        $logger->debug('Start index method');

        $db = Application::getInstance()->get(Db::class);
        $db->query();

        echo 'Run index method index controller';
    }

    public function user()
    {
        echo 'User method';
    }
}