<?php

namespace TopSoft4U\Connector\Utils;

class CountryIso
{
    private string $value;

    public function __construct(string $iso)
    {
        $this->value = $iso;
    }

    public function __toString()
    {
        return $this->value;
    }
}
