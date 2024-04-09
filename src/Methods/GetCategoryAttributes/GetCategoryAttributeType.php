<?php

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

use TopSoft4U\Connector\Utils\SimpleToString;

class GetCategoryAttributeType extends SimpleToString
{
    public static function MostRecentlyUsed(): self
    {
        return new self("mru");
    }

    public static function Boolean(): self
    {
        return new self("bool");
    }

    public static function Integer(): self
    {
        return new self("int");
    }

    public static function Text(): self
    {
        return new self("text");
    }

    public static function Date(): self
    {
        return new self("date");
    }
}
