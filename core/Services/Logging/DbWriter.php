<?php


namespace Logging;


class DbWriter implements WriterInterface
{
    protected $db;

    public function __construct($db = null)
    {
        $this->db = $db;
    }

    public function write($message)
    {
        file_put_contents('../data/db.txt', $message . PHP_EOL, FILE_APPEND);
    }
}