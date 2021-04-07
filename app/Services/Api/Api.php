<?php


namespace App\Services\Api;


use Logging\Logger;

class Api
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
}