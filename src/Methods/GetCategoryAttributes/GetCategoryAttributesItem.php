<?php

namespace TopSoft4U\Connector\Methods\GetCategoryAttributes;

class GetCategoryAttributesItem
{
    public int $id;
    public ?string $modified = null;
    public string $name;
    public ?string $description = null;
    public string $type;
    /**
     * @var int[]
     */
    public array $categoryIds;
    public int $variantType;
    public ?string $unit = null;


    public static function FromData(array $data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->modified = $data["modified"];
        $item->name = $data["name"];
        $item->description = $data["description"];
        $item->type = $data["type"];
        $item->categoryIds = $data["categoryids"];
        $item->variantType = $data["varianttype"];
        $item->unit = $data["unit"];

        return $item;
    }
}
