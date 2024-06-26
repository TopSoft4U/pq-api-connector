<?php

namespace TopSoft4U\Connector\Utils;

class Currency extends SimpleToString
{
    public function __construct(string $value)
    {
        // Must be 3 letters, can be uppercase or lowercase
        if (!preg_match('/^[A-Za-z]{3}$/', $value))
            throw new \InvalidArgumentException("Invalid currency format - expected 3 letters");

        parent::__construct($value);
    }

    //region Helpers methods for predefined currencies
    public static function EUR(): Currency
    {
        return new Currency("EUR");
    }

    public static function USD(): Currency
    {
        return new Currency("USD");
    }

    public static function PLN(): Currency
    {
        return new Currency("PLN");
    }

    public static function CZK(): Currency
    {
        return new Currency("CZK");
    }
    //endregion
}
