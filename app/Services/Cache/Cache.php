<?php


namespace App\Services\Cache;


/**
 * Class Cache
 * Пример какого-то полезного сервиса
 *
 * @package App\Services\Cache
 */
class Cache
{
    protected $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function getFilename()
    {
        return $this->filename;
    }
}