<?php

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantItem
{
    public string $groupName;
    public int $attributeId;
    public array $subItems = [];

    public static function FromData($data): self
    {
        $result = new self();
        $result->groupName = $data["groupname"];
        $result->attributeId = $data["attributeid"];
        foreach ($data["subitems"] as $row) {
            $result->subItems[] = GetProductVariantSubItem::FromData($row);
        }

        return $result;
    }
}
