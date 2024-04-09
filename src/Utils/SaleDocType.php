<?php

namespace TopSoft4U\Connector\Utils;

class SaleDocType extends SimpleToString
{
    public static function Invoice(): self
    {
        return new self("invoice");
    }

    public static function Receipt(): self
    {
        return new self("receipt");
    }
}
