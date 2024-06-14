<?php

namespace TopSoft4U\Connector\Utils;

class OutputType extends SimpleToString
{
    private const ALLOWED_TYPES = ["json", "xml"];

    public function __construct(string $value)
    {
        $value = strtolower($value);
        if (!in_array($value, self::ALLOWED_TYPES))
            throw new \InvalidArgumentException("Invalid output type: $value");

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
}
