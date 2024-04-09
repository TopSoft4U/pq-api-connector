<?php

namespace TopSoft4U\Connector\Utils;

class OutputType extends SimpleToString
{
    private function __construct(string $value)
    {
        parent::__construct($value);
    }

    public static function Json(): OutputType
    {
        return new OutputType("json");
    }

    public static function XML(): OutputType
    {
        return new OutputType("xml");
    }

    public static function CSV(): OutputType
    {
        return new OutputType("csv");
    }
}
