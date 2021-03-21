<?php


namespace Logging;


interface WriterInterface
{
    public function write(string $content);
}