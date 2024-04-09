<?php

namespace TopSoft4U\Connector\Methods\CreateSale;

use TopSoft4U\Connector\Utils\SimpleToString;

class CreateSaleOwnLabelMode extends SimpleToString
{
    public static function URL(): self
    {
        return new self("url");
    }

    public static function PDF(): self
    {
        return new self("pdf");
    }
}
