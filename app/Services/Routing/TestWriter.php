<?php


namespace App\Services\Routing;


use Core\Services\Database\Db;
use Logging\WriterInterface;

class TestWriter implements WriterInterface
{
    protected $test;

    public function __construct(Db $db, $test)
    {
        $this->test = $test;
    }

    public function write(string $content) {
        echo 'Test writer' . PHP_EOL;
    }
}