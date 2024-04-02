<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantItem
{
    public string $groupName;
    public int $attributeId;
    public array $subItems = [];
    public ?string $unit = null;
    public ?string $type = null;

    public static function FromData($data): self
    {
        $item = new self();
        $item->groupName = $data["groupname"];
        $item->attributeId = $data["attributeid"];
        $item->unit = $data["unit"];
        $item->type = $data["type"];

        foreach ($data["subitems"] as $row) {
            $item->subItems[] = GetProductVariantSubItem::FromData($row);
        }

        return $item;
    }
}
