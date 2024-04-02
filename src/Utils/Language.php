<?php

namespace TopSoft4U\Connector\Utils;

class Language
{
    public string $value;

    public function __construct(string $locale)
    {
        // Must be 3 letters, can be uppercase or lowercase
        if (!preg_match('/^[A-Za-z]{2}$/', $locale))
            throw new \Exception("Invalid locale format - expected 2 letters");

        $this->value = $locale;
    }

    public function __toString()
    {
        return $this->value;
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
