<?php


namespace Logging;


class FileWriter implements WriterInterface
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function write($message)
    {
        file_put_contents($this->file, $message, FILE_APPEND);
    }
}