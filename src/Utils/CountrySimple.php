<?php

namespace TopSoft4U\Connector\Utils;

class CountrySimple extends DictionaryValue
{
    public string $iso;

    public function __construct(int $id, string $name, string $iso)
    {
        parent::__construct($id, $name);
        $this->iso = $iso;
    }
}
