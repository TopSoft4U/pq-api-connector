<?php

namespace TopSoft4U\Connector\Methods\GetProductAttributes;

class GetProductAttributeItem
{
    public ?int $id;
    public ?string $name;
    public ?string $type;
    public string $value;
    public int $fkProduct;
    public int $fkCategory;
    public bool $isGrouping;

    public static function FromData($data): self
    {
        $item = new self();
        $item->id = $data["id"];
        $item->name = $data["name"];
        $item->type = $data["type"];
        $item->value = $data["value"];
        $item->fkProduct = $data["fkproduct"];
        $item->fkCategory = $data["fkcategory"];
        $item->isGrouping = $data["isgrouping"];

        return $item;
    }
}
