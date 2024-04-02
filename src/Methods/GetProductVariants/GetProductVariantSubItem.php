<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantSubItem
{
    public string $attributeValue;
    public int $productId;
    public bool $inStock;
    public ?string $thumbnail;
    public bool $fullMatch;
    public ?string $slug = null;

    public static function FromData(array $data): self
    {
        $item = new self();
        $item->attributeValue = $data["attributevalue"];
        $item->productId = $data["productid"];
        $item->inStock = $data["instock"];
        $item->thumbnail = $data["thumbnail"];
        $item->fullMatch = $data["fullmatch"];
        $item->slug = $data["slug"] ?? null;

        return $item;
    }
}
