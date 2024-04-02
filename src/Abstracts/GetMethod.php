<?php

namespace TopSoft4U\Connector\Abstracts;

abstract class GetMethod extends BaseMethod
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
