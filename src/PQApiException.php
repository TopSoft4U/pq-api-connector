<?php

namespace TopSoft4U\Connector;

class PQApiException extends \Exception
{
    public int $statusCode;

    public function __construct(int $statusCode, string $message)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }
}
