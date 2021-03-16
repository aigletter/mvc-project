<?php


namespace Core\Contracts;


/**
 * Interface RouterInterface
 * Интерфейс для роутера
 *
 * @package Core\Contracts
 */
interface RouterInterface
{
    /**
     * От роутера требуется лишь одно действие, есть ли сконфигурированный роут
     *
     * @return callable
     */
    public function route(): callable;
}