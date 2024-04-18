<?php

namespace TopSoft4U\Connector\Methods\Ping;

use TopSoft4U\Connector\Abstracts\GetRequest;

class PingRequest extends GetRequest
{
    public function getUrl(): string
    {
        return "/ping";
    }

    public function getQueryParams(): array
    {
        return [];
    }

    public function formatData($data): void
    {
    }
}
