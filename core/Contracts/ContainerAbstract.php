<?php


namespace Core\Contracts;


use Core\Application;

abstract class ContainerAbstract implements ContainerInterface
{
    /**
     * @var array Массив приязок названий севрисов и фабрик, которые умеют их создавать
     */
    protected $bindings = [];

    /**
     * @var array Массив уже созданных инстансов.
     * Сервисы в него добавляются при первом обращении к ним. Впоследствии новые экземляры не создаются, а берутся отсюда
     */
    protected $services = [];

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
                /*if (!class_exists($factory) || !is_a($factory, FactoryAbstract::class, true)) {
                    throw new \Exception('Can not create factory');
                }*/

                $this->bindings[$name] = $factory;
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

        if (array_key_exists($name, $this->bindings)) {
            if (is_array($this->bindings[$name]) && isset($this->bindings[$name]['factory'])) {
                $factory = $this->bindings[$name];
                if (is_array($factory)) {
                    $options = $factory['options'] ?? [];
                    $factory = $factory['factory'];
                }
                $factory = new $factory($this, $options ?? []);
                $instance = $factory->createInstance();
            } elseif ($this->bindings[$name]['class']) {
                $options = $this->bindings[$name]['options'] ?? [];
                $instance = $this->makeInstance($this->bindings[$name]['class'], $options);
            }

            $this->services[$name] = $instance;

            return $instance;
        }

        throw new \Exception('Can not create service');
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

    public function makeInstance($className, $options = [])
    {
        if (!class_exists($className)) {
            throw new \Exception('Class not found');
        }

        $reflectionClass = new \ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        $dependencies = [];
        if ($constructor) {
            $dependencies = $this->resolveDependencies($constructor, $options);
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function resolveDependencies(\ReflectionFunctionAbstract $reflectionMethod, $options = [])
    {
        $dependencies = [];
        foreach ($reflectionMethod->getParameters() as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if ($type) {
                $className = $type->getName();
                $instance = $this->get($className);
                $dependencies[$name] = $instance;
            } elseif (isset($options[$name])) {
                $dependencies[$name] = $options[$name];
            }
        }

        return $dependencies;
    }
}