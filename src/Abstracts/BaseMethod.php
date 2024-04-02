<?php

namespace TopSoft4U\Connector\Abstracts;

abstract class BaseMethod
{
    abstract public function getUrl(): string;
    abstract public function getMethodType(): string;
    abstract public function getQueryParams(): array;
    abstract public function getBodyData(): array;
    abstract public function formatData($data);
}
