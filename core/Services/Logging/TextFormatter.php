<?php


namespace Logging;


class TextFormatter implements FormatterInterface
{
    protected $format = '{level}: {message} - {context}';

    public function __construct($format = null)
    {
        if ($format) {
            $this->format = $format;
        }
    }

    public function format(string $level, string $message, array $context = []): string
    {
        $log = str_replace('{level}', $level, $this->format);
        $log = str_replace('{message}', $message, $log);
        $context = $this->formatContext($context);
        $log = str_replace('{context}', $context, $log);
        return $log;
    }

    protected function formatContext($context)
    {
        return json_encode($context);
    }
}