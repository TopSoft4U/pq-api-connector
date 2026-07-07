<?php
declare(strict_types=1);

namespace TopSoft4U\Connector\Methods\GetProductVariants;

class GetProductVariantItem
{
    public string $groupName;
    public int $attributeId;
    /**
     * @var \TopSoft4U\Connector\Methods\GetProductVariants\GetProductVariantSubItem[]
     */
    public array $subItems = [];
    public ?string $unit = null;
    public ?string $type = null;

    /**
     * @param array<string, mixed> $data
     */
    public static function FromData(array $data): self
    {
        $item = new self();
        $item->groupName = is_string($data["groupname"]) ? $data["groupname"] : "";
        $item->attributeId = is_numeric($data["attributeid"]) ? (int)$data["attributeid"] : 0;
        $item->unit = is_string($data["unit"]) ? $data["unit"] : null;
        $item->type = is_string($data["type"]) ? $data["type"] : null;

        /** @var array<int, array<string, mixed>> $subitems */
        $subitems = is_array($data["subitems"] ?? null) ? $data["subitems"] : [];
        foreach ($subitems as $row) {
            $item->subItems[] = GetProductVariantSubItem::FromData($row);
        }

        return $item;
    }
}
