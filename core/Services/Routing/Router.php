<?php


namespace Core\Services\Routing;


use Core\Contracts\RouterInterface;

/**
 * Class Router
 * Базовая реализация роутера
 *
 * @package Core\Services\Routing
 */
class Router implements RouterInterface
{
    /**
     * @var array массив сконфигурированных роутов
     */
    protected $routes = [];

    /**
     * Router constructor.
     * В конструкторе просто подключаем файл routers.php, если он есть
     * Но роуты можно добавлять и програмно - с помощью вызова метода getRoute()
     *
     * @see Router::addRoute()
     */
    public function __construct()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/../routes/routes.php')) {
            include $_SERVER['DOCUMENT_ROOT'] . '/../routes/routes.php';
        }
    }

    /**
     * Метод добавляет роут
     *
     * @param string $method
     * @param string $path
     * @param string $action
     */
    public function addRoute(string $method, string $path, callable $action)
    {
        $this->routes[$method][$path] = $action;
    }

    /**
     * Метод определяет есть ли сконфигурированный роут для текущего запроса
     *
     * @return callable
     * @throws \Exception
     */
    public function route(): callable
    {
        // Получаем метод и путь запроса и проверяем есть ли для него сконфигурированный роут
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $action = $this->routes[$method][$path] ?? null;
        // Если роут есть, возвращаем колбек функцию, вызывающию соответствующий роут
        if ($action && is_callable($action)) {
            return function() use ($method, $path) {
                return $this->routes[$method][$path]();
            };
        }

        throw new \Exception('Can not define route');
    }
}