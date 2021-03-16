<?php


namespace Core\Contracts;

/**
 * Interface ContainerInterface
 * Интерфейс контейнера
 *
 * @package Core\Contracts
 */
interface ContainerInterface
{
    /**
     * Получает сервис по имени
     *
     * @param $name
     * @return object|null
     */
    public function get($name);

    /**
     * Проверяет есть ли сервис или привязка в контейнере
     *
     * @param $name
     * @return bool
     */
    public function has($name);
}