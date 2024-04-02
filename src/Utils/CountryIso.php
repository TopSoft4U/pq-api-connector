<?php

namespace TopSoft4U\Connector\Utils;

class CountryIso
{
    private string $value;

    public function __construct(string $iso)
    {
        // Must be 2 characters long, only letters
        if (!preg_match('/^[a-zA-Z]{2}$/', $iso))
            throw new \InvalidArgumentException("Invalid country ISO code: $iso");

        $this->value = $iso;
    }

    public function __toString()
    {
        return $this->value;
    }
}
