<?php

namespace TopSoft4U\Connector\Utils;

class CountryIso extends SimpleToString
{
    public function __construct(string $value)
    {
        // Must be 2 characters long, only letters
        if (!preg_match('/^[a-zA-Z]{2}$/', $value))
            throw new \InvalidArgumentException("Invalid country ISO code: $value");

        parent::__construct($value);
    }
}
