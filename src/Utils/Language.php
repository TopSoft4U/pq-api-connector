<?php

namespace TopSoft4U\Connector\Utils;

class Language extends SimpleToString
{

    public function __construct(string $value)
    {
        // Must be 3 letters, can be uppercase or lowercase
        if (!preg_match('/^[A-Za-z]{2}$/', $value))
            throw new \Exception("Invalid locale format - expected 2 letters");

        parent::__construct($value);
    }

    //region Helpers methods for predefined languages
    public static function Polish(): Language
    {
        return new Language("pl");
    }

    public static function English(): Language
    {
        return new Language("en");
    }

    public static function Czech(): Language
    {
        return new Language("cs");
    }
    //endregion
}
