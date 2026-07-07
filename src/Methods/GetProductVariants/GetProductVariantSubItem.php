<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantSubItem
{
    public string $attributeValue;
    public int $productId;
    public bool $inStock;
    public ?string $thumbnail;
    public bool $fullMatch;
    public ?string $slug = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->attributeValue = is_string($data["attributevalue"]) ? $data["attributevalue"] : "";
        $item->productId = is_numeric($data["productid"]) ? (int)$data["productid"] : 0;
        $item->inStock = (bool)$data["instock"];
        $item->thumbnail = is_string($data["thumbnail"]) ? $data["thumbnail"] : null;
        $item->fullMatch = (bool)$data["fullmatch"];
        $item->slug = is_string($data["slug"] ?? null) ? $data["slug"] : null;

        return $item;
    }
}
