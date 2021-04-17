<?php


namespace App\Controllers;


use App\Services\Cache\Cache;
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
    /*protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }*/

    public function index(Logger $logger, Db $db, Cache $cache)
    {
        /*$logger = Application::getInstance()->get(Logger::class);*/
        $logger->debug('Start index method');

        $api = Application::getInstance()->get('api');

        /*$db = Application::getInstance()->get(Db::class);
        $db->query();*/

        echo 'Run index method index controller';
    }
}