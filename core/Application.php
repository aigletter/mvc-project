<?php


namespace Core;


use Core\Contracts\ContainerInterface;
use Core\Contracts\FactoryAbstract;
use Core\Contracts\RouterInterface;
use Core\Contracts\RunableInterface;

/**
 * Class Application
 * Класс приложения, который служит контейнером для севрисов и запускает роутинг
 *
 * @package Core
 */
class Application implements RunableInterface, ContainerInterface
{
    /**
     * @var Application инстанс приложения (singleton)
     */
    protected static $instance;

    /**
     * @var array Массив приязок названий севрисов и фабрик, которые умеют их создавать
     */
    protected $bingings = [];

    /**
     * @var array Массив уже созданных инстансов.
     * Сервисы в него добавляются при первом обращении к ним. Впоследствии новые экземляры не создаются, а берутся отсюда
     */
    protected $services = [];

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
     * Запрещаем создание обьекта через new (singleton)
     *
     * Application constructor.
     */
    protected function __construct()
    {
    }

    /**
     * Метод инициализации. Получает конфиг и на данном этапе определяет привязки сервисов и фабрик для их создания.
     * @param array $config
     * @throws \Exception
     */
    public function initialize(array $config)
    {
        if (!empty($config['services'])) {
            foreach ($config['services'] as $name => $factory) {
                if (!class_exists($factory) || !is_a($factory, FactoryAbstract::class, true)) {
                    throw new \Exception('Can not create factory');
                }

                $this->bingings[$name] = $factory;
            }
        }
    }

    /**
     * Метод контейнера для получения сервисов.
     * В случае первого обращения к сервису создает экземпляр с помощью фабрики.
     * В случае повторных обращений к сервису просто достает его из контейнера и возвращает
     *
     * @param $name
     *
     * @return mixed|null
     */
    public function get($name)
    {
        if (array_key_exists($name, $this->services)) {
            return $this->services[$name];
        }

        if (array_key_exists($name, $this->bingings)) {
            $factory = $this->bingings[$name];
            $factory = new $factory();
            $instance = $factory->createInstance();
            $this->services[$name] = $instance;

            return $instance;
        }

        return null;
    }

    /**
     * Должен проверять есть ли в контейнере сервис с указанным названием
     *
     * @param $name
     */
    public function has($name)
    {
        // TODO: Implement has() method.
    }

    /**
     * Запуск обработки запроса
     * В дальнейшем обраотку запросов модифицируем с применение стандарта PSR-15
     *
     * @todo Сделать обработку запросов по спецификации PSR-15
     */
    public function run()
    {
        // Получаем инстанс сервиса роутера
        $router = $this->get(RouterInterface::class);

        // Запускаем, собственно, роутинг.
        // Роутер должен определить, есть ли вызов метода
        $action = $router->route();

        // Если для запроса нет роутов, вернем 404
        if (!$action) {
            http_response_code(404);
            echo '404';
            return;
        }

        $action();
    }
}