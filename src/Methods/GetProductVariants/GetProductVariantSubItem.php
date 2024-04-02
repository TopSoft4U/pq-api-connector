<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantSubItem
{
    public string $attributeValue;
    public int $productId;
    public bool $inStock;

    public static function FromData(array $data): self
    {
        $result = new self();
        $result->attributeValue = $data["attributevalue"];
        $result->productId = $data["productid"];
        $result->inStock = $data["instock"];

        return $result;
    }
}
