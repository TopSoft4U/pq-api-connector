<?php

namespace TopSoft4U\Connector\Utils;

use JsonSerializable;

abstract class SimpleToString implements JsonSerializable
{
    private string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }
}
