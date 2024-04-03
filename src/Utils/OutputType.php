<?php

namespace TopSoft4U\Connector\Utils;

class OutputType
{
    public string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
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

    public function __toString()
    {
        return $this->value;
    }
}
