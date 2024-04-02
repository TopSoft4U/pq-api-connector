<?php

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

class GetCategoryAttributeType
{
    private string $value;
    
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->value;
    }

    public static function MostRecentlyUsed(): self
    {
        return new self("mru");
    }

    public static function Boolean(): GetCategoryAttributeType
    {
        return new self("bool");
    }
    
    public static function Integer(): GetCategoryAttributeType
    {
        return new self("int");
    }
    
    public static function Text(): GetCategoryAttributeType
    {
        return new self("text");
    }
    
    public static function Date(): GetCategoryAttributeType
    {
        return new self("date");
    }
}
