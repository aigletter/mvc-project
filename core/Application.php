<?php


namespace Core;


use Core\Contracts\ContainerAbstract;
use Core\Contracts\RunableInterface;
use Logging\Logger;

/**
 * Class Application
 * Класс приложения, который служит контейнером для севрисов и запускает роутинг
 *
 * @package Core
 */
class Application extends ContainerAbstract implements RunableInterface
{
    /**
     * @var Application инстанс приложения (singleton)
     */
    protected static $instance;

    /**
     * Статический метод для получения экземпляра приложения (singleton).
     * Нужен для того, чтобы можно было получить сервис из него в любом месте кода.
     * Не самая лучшая реализация. Но мы это исправим в дальнейшем
     *
     * @return Application
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Запуск обработки запроса
     * В дальнейшем обраотку запросов модифицируем с применение стандарта PSR-15
     *
     * @todo Сделать обработку запросов по спецификации PSR-15
     */
    public function run()
    {
        $logger = $this->get(Logger::class);
        $logger->debug('Start application', [
            'test' => 'Hello'
        ]);

        // Получаем инстанс сервиса роутера
        $router = $this->get('router');

        // Запускаем, собственно, роутинг.
        // Роутер должен определить, есть ли вызов метода
        $route = $router->route();

        $action = $this->makeCallable($route);
        //$controller->{$action[1]}();


        // Если для запроса нет роутов, вернем 404
        if (!$action) {
            http_response_code(404);
            echo '404';
            return;
        }

        $action();
    }

    protected function makeCallable($route)
    {
        $controller = $this->makeInstance($route[0]);
        $reflectionMethod = new \ReflectionMethod($controller, $route[1]);
        $dependencies = $this->resolveDependencies($reflectionMethod);
        return function() use ($controller, $reflectionMethod, $dependencies){
            $reflectionMethod->invokeArgs($controller, $dependencies);
        };
    }
}