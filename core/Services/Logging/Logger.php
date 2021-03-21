<?php


namespace Logging;


class Logger extends \Psr\Log\AbstractLogger
{

    protected $writer;

    protected $formatter;

    public function __construct(WriterInterface $writer, FormatterInterface $formatter)
    {
        $this->writer = $writer;
        $this->formatter = $formatter;
    }

    public function log($level, $message, array $context = array())
    {
        $content = $this->formatter->format($level, $message, $context);
        $this->writer->write($content);
    }
}