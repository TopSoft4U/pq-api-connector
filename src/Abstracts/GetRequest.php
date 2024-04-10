<?php

namespace TopSoft4U\Connector\Abstracts;

abstract class GetRequest extends BaseRequest
{
    public function getMethodType(): string
    {
        return "GET";
    }

    public function getBodyData(): array
    {
        return [];
    }
}
